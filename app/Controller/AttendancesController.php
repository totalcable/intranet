<?php

/**
  This module for Attendances
  it is depend on roaster details table
 * */
App::uses('CakeEmail', 'Network/Email');
App::import('Controller', 'Reports');

class AttendancesController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();

        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
        }
        $this->Auth->allow('');
    }

    function request_agent() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $in = date("h:i:sa");
        $agent = $this->User->query("SELECT * FROM users
                left join roles on roles.id = users.role_id
                WHERE (log_status = 'complete' OR log_status = 'request') AND role_id = 14 AND last_duty_date = '$date' AND status = 'active'");
        if (!empty($agent)) {
            $fix_time = $agent[0]['users']['last_duty_sift'];
            $log_status = $agent[0]['users']['log_status'];
        }
        //Time take in variable for validation start
        // in time end
        if ($fix_time = 'Morning (07:30 - 01:00)') {
            $s_time = substr($fix_time, 9, 5); //fix time  
        } elseif ($fix_time = 'Afternoon (01:00 - 09:00)') {
            $s_time = substr($fix_time, 11, 5); //fix time 
        } elseif ($fix_time = 'Night(09:00 - 03:00') {
            $s_time = substr($fix_time, 7, 5); //fix time 
        }
        //Time take in variable for validation end 
        $request_list = $agent;
        $this->set(compact('request_list', 's_time', 'log_status', 'fix_time'));
    }

    function request_approve($id) {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date_se = date("Y-m-d");
        $id = $this->params['pass'][0];
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        //data retrive data for update roaster detail table start
        $new_info = $this->User->query("SELECT * FROM users where id = $id");
        $in = $new_info[0]['users']['last_in_time'];
        $shift = $new_info[0]['users']['last_duty_sift'];
        $pc_first_log_info = $new_info[0]['users']['pc_id_user'];
        $user_logout_info = $new_info[0]['users']['user_logout_info'];
//        $in = '09:20:00pm';
        $in_office = strtotime($in); // last log in time present of office
        $out = $new_info[0]['users']['last_out_time'];
//        $out_office = strtotime($out); // last log in time present of office
        $out_office = strtotime('09:00:00pm'); // last log in time present of office
        $a_status = $new_info[0]['users']['log_status'];
//        pr($shift.' '.$a_status); exit;
        //data retrive for update roaster detail table end
        //data retrive by date , record id start
//        pr($date_se.' '.$id); exit;
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date_se' AND user_id = $id  order by alphabet");

        #$a_status = $duty[0]['roaster_details']['attend_status'];
        if(!empty($duty)){
           $r_id = $duty[0]['roaster_details']['id']; 
        }
        

        if ($a_status == 'request') {
            //pr($shift.'Morning (07:30 - 01:00)'); exit;
            //Shift name set
            if ($shift == 'Morning (07:30 - 01:00)') {
                //pr($shift.'Morning (07:30 - 01:00)'); exit;
                $f_time = strtotime('07:45:00am'); // fix office time
            } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                $f_time = strtotime('01:15:00pm'); // fix office time
            } elseif ($shift == 'Night (09:00 - 03:00)') {
                $f_time = strtotime('09:15:00pm'); // fix office time
            }
            //pr($in_office.' I f '.$f_time);

            if ($in_office > $f_time) { //for late time
//                pr('one');
//                exit;
                $in_office1 = strtotime('+15 minutes', $in_office); // +15 minius for find out late time

                $total_time = ($in_office1 - $f_time) / 60;
                $e_minutes = floor(($total_time / 60) % 60); //h
                $e_seconds = $total_time % 60; //min
                $e_td = $e_minutes . ':' . $e_seconds;
                //pr($e_td.' lat'); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("si_approve_pc_info", $pc_info);
                $this->RoasterDetail->saveField("late_time", $e_td);
            } elseif ($f_time > $in_office) {//for extra time
                //pr('two'); exit;
                $in_office1 = strtotime('-15 minutes', $f_time); // -15 minius for find out extra time
                $total_time = ($in_office1 - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60);
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;
                $minus = substr($e_td, 2, 1); // find minus 
                if ($minus == '-') {
                    $e_td = '00:00:00';
                }
                //pr($e_td.'  ext'.'start '.$minus); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("si_approve_pc_info", $pc_info);
                $this->RoasterDetail->saveField("extra_time", $e_td);
            }
            //pr('last'); exit;
            $att_status = 'start';
        } elseif ($a_status == 'complete') {
//            pr('here'); exit;
            //Shift name set
            if ($shift == 'Morning (07:30 - 01:00)') {
                $f_time = strtotime('07:45:00am'); // fixt office in time
                $o_time = strtotime('01:00:00pm'); // fixt office out time
            } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                $f_time = strtotime('01:15:00pm'); // fix office time
                $o_time = strtotime('09:00:00pm'); // fixt office out time
            } elseif ($shift == 'Night (09:00 - 03:00)') {
                $f_time = strtotime('09:15:00pm'); // fix office time
                $o_time = strtotime('03:00:00am'); // fixt office out time
            }
//             pr($o_time . ' ' . $out_office);
//            exit;
            if ($in_office <= $f_time && $out_office >= $o_time) { // When an employee come time to time
//                  pr($shift); 
                // $in_office1 = strtotime('+15 minutes', $out_office); // +15 minius for find out late time
//                $total_time = ($out_office - $in_office) / 60;
//                $e_minutes = floor(($total_time / 60) % 60); //h
//                $e_seconds = $total_time % 60; //min
//                $e_td = $e_minutes . ':' . $e_seconds;
                if ($shift == 'Morning (07:30 - 01:00)') {
                              
//                    pr('m');
                    $e_td = '05:30:00';
                } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                    $e_td = '08:00:00';
                } elseif ($shift == 'Night (09:00 - 03:00)') {
                    $e_td = '06:00:00';
                }
//                 pr($e_td. ' ' . 'good');
//                  exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("pc_id", $pc_info);
                $this->RoasterDetail->saveField("total_duty", $e_td);
            } elseif ($in_office >= $f_time) {//// When an employee come late
                //$f_time = strtotime('07:30:00am'); // fix office in time
                //$total_late_time = ($in_office - $f_time); // fixt office in time
                //$in_office1 = strtotime('-15 minutes', $out_office); // -15 minius for find out extra time
                // pr($in_office . ' >' . $out_office . 'pp');
                $total_time = ($out_office - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60);
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;

                // pr($e_td.' last'); exit;
                $this->RoasterDetail->id = $r_id;
                 $this->RoasterDetail->saveField("pc_id", $pc_info);
                $this->RoasterDetail->saveField("total_duty", $e_td);
            }
//            pr('last 2');
//            exit;
            $att_status = 'approve';
        }
//pr($e_td.' last'); exit;
        // update roaster detail start
        $data4rd = array();
        $data4rd['RoasterDetail'] = array(
            'id' => $r_id,
            'in_time' => $in,
            'out_time' => $out,
            'user_login_info' => $pc_first_log_info,
            'user_logout_info' => $user_logout_info,
            'attend_status' => $att_status
        );
        $this->RoasterDetail->save($data4rd);
        // update roaster detail end
        // user table update start
        $this->User->id = $id;
        $this->User->saveField("log_status", "no");
        //user table update end
        //user table update for blank start
        if ($a_status == 'complete') {
            $this->User->id = $id;
            $this->User->saveField("last_duty_date", "0000-00-00");
            $this->User->saveField("last_in_time", "00:00:00");
            $this->User->saveField("last_out_time", "00:00:00");
            $this->User->saveField("pc_id_user", "");
            $this->User->saveField("user_logout_info", "");
            $this->User->saveField("last_duty_sift", "");
        }
        //user table update for blank end
        $msg = '<div class="alert alert-successful">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong> Approved</strong>
                        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function request_si() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $in = date("h:i:sa");
        $si = $this->User->query("
                SELECT * FROM users
                left join roles on roles.id = users.role_id
                WHERE (log_status = 'complete' OR log_status = 'request') AND role_id = 7 AND last_duty_date = '$date' AND status = 'active'");
        $request_list = $si;
        $this->set(compact('request_list'));
    }

    function requested_delete($id = null) {
        $this->loadModel('User');
        $this->User->id = $id;
        $this->User->saveField("log_status", "no");
        $this->User->saveField("last_duty_date", '0000-00-00');
        $this->User->saveField("last_in_time", '');
        $this->User->saveField("last_out_time", '');
        $msg = '<div class="alert alert-successful">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> Record has been deleted</strong>
                </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function present_roaster() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $in = date("h:i:sa");
        //Time take in variable for validation end 
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details                 
        inner join users on users.id = roaster_details.user_id
        WHERE `date`= '$date' AND attend_status = 'no' order by alphabet");
        $users = $this->User->find('list', array('order' => array('User.name' => 'ASC')));
        $this->set(compact('duty', 'users'));
    }

    function user_status_absent($id) {
        $this->loadModel('RoasterDetail');
        $this->RoasterDetail->id = $id;
        $this->RoasterDetail->saveField("total_duty", '00:00:00');
        $this->RoasterDetail->saveField("attend_status", 'absent');
        $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Status change successfully:-) </strong>
		</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('present_roaster');
    }

    function user_swap() {
        $this->loadModel('RoasterDetail');
        $this->loadModel('Swap');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect start
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        //pc , ip and date time collect end      
        // update roaster detail start
        $data4rd = array();
        $data4rd['RoasterDetail'] = array(
            'id' => $this->request->data['RoasterDetail']['id'],
            'emp_id' => $this->request->data['RoasterDetail']['new_emp_id']
        );
        $this->RoasterDetail->save($data4rd);

        //Swap tbl insert data      
        $this->request->data['Swap']['user_id'] = $loggedUser['id'];
        $this->request->data['Swap']['pc_id'] = $pc_info;
        $this->request->data['Swap']['swap_type'] = $this->request->data['RoasterDetail']['swap_type'];
        $this->request->data['Swap']['swap_by'] = $this->request->data['RoasterDetail']['new_emp_id'];
        $this->request->data['Swap']['swap_for'] = $this->request->data['RoasterDetail']['old_emp'];
        $this->request->data['Swap']['shift_name'] = $this->request->data['RoasterDetail']['shift'];
        $this->request->data['Swap']['date'] = $this->request->data['RoasterDetail']['date'];
        $this->request->data['Swap']['comment'] = $this->request->data['RoasterDetail']['comment_swap'];
        $this->Swap->save($this->request->data);

        $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Roaster changed successfully:-) </strong>
			</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function attend_all() {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $datrange = json_decode($this->request->data['RoasterDetail']['daterange'], true);
            $ds = $datrange['start'];
            $de = $datrange['end'];
            if ($ds == $de) {
                $conditions = "roaster_details.date >= '$ds' AND  roaster_details.date <= '$de'";
            } else {
                $conditions = " roaster_details.date >= '$ds' AND  roaster_details.date <= '$de'";
            }
            $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details
                    inner join users on users.id = roaster_details.user_id
                     WHERE attend_status = 'approve' AND $conditions");
            $this->set(compact('duty'));
        } else {
            $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details inner join users on users.id = roaster_details.user_id WHERE attend_status = 'approve'");
            $this->set(compact('duty'));
        }
    }

    function attend_one($id) {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details inner join users on users.id = roaster_details.user_id WHERE attend_status = 'approve' AND roaster_details.user_id = $id order by roaster_details.id limit 0,31");
        $this->set(compact('duty'));
    }

    function emp_attend_byadmin() {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        if ($this->request->is('post') || $this->request->is('pull')) {
            $date = json_decode($this->request->data['User']['date']);
            $in = date("h:i:sa");
            $date_s = $date->start;
            $loggedUser = $this->Auth->user();

            //pc , ip and date time collect start
            $myIp = getHostByName(php_uname('n'));
            $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $date = date("Y-m-d h:i:sa");
            $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
            //pc , ip and date time collect end
          
            $id = $this->request->data['User']['new_user_id'];
            $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date_s' AND user_id = $id  AND attend_status = 'no'");
            if (!empty($duty[0]['roaster_details']['shift_name_time'])) {
                // $fix_time = $duty[0]['roaster_details']['shift_name_time'];//dynamic data
                $fix_time = 'Night (09:00 - 03:00)'; //static data
                //Time take in variable for validation start
                if ($fix_time == 'Night (09:00 - 03:00)') {
                    $this->User->id = $id;
                    $this->User->saveField("last_duty_date", $date_s);
                    $this->User->saveField("last_in_time", $in);
                    $this->User->saveField("last_duty_sift", 'Night (09:00 - 03:00)');
                    $this->User->saveField("log_status", 'request');
                    $this->User->saveField("pc_id_user", $pc_info);
                    $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Attend information inserted successfully:-) </strong>
			</div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->referer());
                }
            }
            $msg = '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> This employee not found in roaster :-) </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $users = $this->User->find('list', array('order' => array('User.name' => 'ASC')));
        $this->set(compact('duty', 'users'));
    }

}

?>