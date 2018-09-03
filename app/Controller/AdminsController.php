<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Controller', 'Transactions'); // mention at top
App::import('Controller', 'Payments');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

class AdminsController extends AppController {

    var $layout = 'admin';
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                )
            ),
            'loginAction' => array(
                'controller' => 'admins',
                'action' => 'login'
            ),
            'loginRedirect' => array('controller' => 'admins', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => 'admins', 'action' => 'login'),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function beforeFilter() {

        parent::beforeFilter();
        $this->Auth->userScope = array('Admin.status' => 'active');
        $this->Auth->allow('create', 'getIsChatAgent');

        // database name must be thum_img,small_img
        $this->img_config = array(
            'picture' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 50,
                'image_y' => 40
            ),
            'parent_dir' => 'pictures',
            'target_path' => array(
                'picture' => WWW_ROOT . 'pictures' . DS
            )
        );


        // create the folder if it does not exist
        if (!is_dir($this->img_config['parent_dir'])) {
            mkdir($this->img_config['parent_dir']);
        }
        foreach ($this->img_config['target_path'] as $img_dir) {
            if (!is_dir($img_dir)) {
                mkdir($img_dir);
            }
        }
    }

    public function isAuthorized($user = null) {
        if ($user['Role']['name'] == 'admin') {
            $this->Auth->loginRedirect = array('controller' => 'orders', 'action' => 'nocontact');
            $this->Auth->deny('dashboard');
        }
        return true;
    }

    public function getIsChatAgent() {
        $this->layout = 'ajax';
        $this->render('nothing');
        $this->loadModel('Admin');
        $admins = $this->Admin->find('first', array(
            'conditions' => array(
                'Role.name' => 'support'
            )
        ));

        if ($admins['Admin']['loggedIn']) {
            echo 'online,' . $admins['Admin']['name'];
        } else {
            echo 'offline';
        }
    }

    function login() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->layout = "admin-login";
        $date = date("Y-m-d");
        $in = date("h:i:sa");
        $payment = new PaymentsController();
        // $payment->auto_recurring_invoice();
        // $payment->auto_recurring_payment();
        // if already logged in check this step
        if ($this->Auth->loggedIn()) {
            return $this->redirect('dashboard'); //(array('action' => 'deshboard'));
        }
        // after submit login form check this step
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('status') == 'active') {
                    // user is activated
                    $pic = $this->Auth->user('picture');
                    $currentDateTime = $date . ' ' . $in;

                    $loggedUser = $this->Auth->user();
                    $u_id = $loggedUser['id'];
                    //pc , ip and date time collect start
                    $myIp = getHostByName(php_uname('n'));
                    $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                    $date = date("Y-m-d h:i:sa");
                    $date_movie = date("Y-m-d");
                    $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
                    //pc , ip and date time collect end
                    //Find out updateable data from roaster detail table
                    $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND user_id = $u_id  AND attend_status != 'approve' order by alphabet");
                    //$shift = $duty[0]['roaster_details']['shift_name_time'];
                    if (!empty($duty[0]['roaster_details']['shift_name_time'])) {

                        // This code check user login time compare with shift in time (15 min + -) start
                        // $fix_time = $duty[0]['roaster_details']['shift_name_time'];//dynamic data
                        $fix_time = 'Morning (07:30 - 01:00)'; //static data
                        //Time take in variable for validation start
                        if ($fix_time == 'Morning (07:30 - 01:00)') {

                            $time = substr($fix_time, 9, 5); //Take in time in variable
                            if ($time == '07:30') { // rule is pc_time
                                // pr('here');pr($time); exit;
                                //$pc_time1 = date("h:i:sa"); //dynamic
                                $pc_time1 = '07:15:00am'; //static
                                //$pc_time = strtotime('01:00:00pm');//pc time/ prsent time
                                $pc_time = strtotime($pc_time1);
                                $f_time = strtotime('07:15:00am'); // Morning login time
                                $l_time = strtotime('01:00:00pm'); //Morning logout time
                            }
//                             pr($f_time.' '.$pc_time.' '.$l_time); exit;
                            if ($pc_time >= $f_time && $pc_time <= $l_time) { // duty start and end time
                                $shift = $duty[0]['roaster_details']['shift_name_time'];
                                $shift_id = $duty[0]['roaster_details']['id'];
                                $inserted_date = $loggedUser['last_duty_date'];

                                //User table update start
                                $id = $this->Auth->user('id');
                                $this->request->data['User']['last_duty_date'] = $date;
                                $this->request->data['User']['last_in_time'] = $in;
                                $this->request->data['User']['last_duty_sift'] = $shift;
                                $this->request->data['User']['log_status'] = 'request';
                                $this->request->data['User']['pc_id_user']= $pc_info;
                                $this->User->id = $id;
//                                   pr($this->request->data); exit;
                                $this->User->save($this->request->data['User']);
                            }
                            // pr('Yes here :-)'); exit;
                        } elseif ($fix_time == 'Afternoon (01:00 - 09:00)') {
                            $time = substr($fix_time, 11, 5); //Take in time in variable
//                            pr($time); exit;
                            if ($time == '01:00') { // rule is pc_time
                                // pr('here'); 
                                //$pc_time1 = date("h:i:sa"); //dynamic
                                $pc_time1 = '12:45:00pm'; //static
                                //$pc_time = strtotime('01:00:00pm');//pc time/ prsent time
                                $pc_time = strtotime($pc_time1);
                                $f_time = strtotime('12:45:00pm'); // Afternoon login time
                                $l_time = strtotime('09:00:00pm'); // Afternoon logout time
                            }

                            if ($pc_time >= $f_time && $pc_time < $l_time) { // duty start and end time
                                //pr($f_time.' '.$pc_time.' '.$l_time); exit;
                                $shift = $duty[0]['roaster_details']['shift_name_time'];
                                $shift_id = $duty[0]['roaster_details']['id'];
                                $inserted_date = $loggedUser['last_duty_date'];

                                //User table update start
                                $id = $this->Auth->user('id');
                                $this->request->data['User']['last_duty_date'] = $date;
                                $this->request->data['User']['last_in_time'] = $in;
                                $this->request->data['User']['last_out_time'] = '00:00:00';
                                $this->request->data['User']['last_duty_sift'] = $shift;
                                $this->request->data['User']['log_status'] = 'request';
                                $this->request->data['User']['pc_id_user']= $pc_info;
                                $this->User->id = $id;
                                $this->User->save($this->request->data['User']);
                            }
                            //pr('last'); exit;
                        } elseif ($fix_time == 'Night(09:00 - 03:00)') {
                            $time = substr($fix_time, 6, 5); //Take in time in variable
                            //pr($time); exit;
                            if ($time == '09:00') { // rule is pc_time
                                // pr('here'); 
                                //$pc_time1 = date("h:i:sa"); //dynamic
                                $pc_time1 = '08:45:00pm'; //static
                                //$pc_time = strtotime('01:00:00pm');//pc time/ prsent time
                                $pc_time = strtotime($pc_time1);
                                $f_time = strtotime('08:45:00pm'); // Afternoon login time
                                // $t_time = strtotime('03:45:00pm'); // Afternoon login time
                                $l_time = strtotime('03:00:00am'); // Afternoon logout time
                            }
                            //pr($f_time.' '.$pc_time.' '.$l_time); 
                            if ($pc_time >= $f_time) { // duty start and end time  && $l_time<=$pc_time
                                //pr($f_time.'1 '.$pc_time.' 2'.$l_time); 
                                // pr('N'); exit;
                                $shift = $duty[0]['roaster_details']['shift_name_time'];
                                $shift_id = $duty[0]['roaster_details']['id'];
                                $inserted_date = $loggedUser['last_duty_date'];

                                //User table update start
                                $id = $this->Auth->user('id');
                                $this->request->data['User']['last_duty_date'] = $date;
                                $this->request->data['User']['last_in_time'] = $in;
                                $this->request->data['User']['last_out_time'] = '00:00:00';
                                $this->request->data['User']['last_duty_sift'] = $shift;
                                $this->request->data['User']['log_status'] = 'request';
                                $this->request->data['User']['pc_id_user']= $pc_info;
                                $this->User->id = $id;
                                $this->User->save($this->request->data['User']);
                            }
                            //pr('last'); exit;
                        }
                        // This code check user login time compare with shift in time (15 min + -) start
                        //Time take in variable for validation end  
                        // pr('Task End'); exit; 
                    }
                    //pr('cant in'); exit;
                    return $this->redirect('/customers/search');
                } else {
                    // user is not activated
                    // log the user out
                    $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>You are blocked, Contact with Adminstrator</strong>
                        </div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->Auth->logout());
                }
            } else {
                $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>Incorrect email/password combination. Try Again</strong>
                        </div>';
                $this->Session->setFlash($msg);
            }
        }
    }

    function requested_si() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $in = date("h:i:sa");
        $si = $this->User->query("
                SELECT * FROM users
                left join roles on roles.id = users.role_id
                WHERE (log_status = 'complete' OR log_status = 'request') AND role_id = 1 AND last_duty_date = '$date' AND status = 'active'");
        $request_list = $si;
        $this->set(compact('request_list'));
    }

    function requested_agent() {
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

    function present_roaster() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $in = date("h:i:sa");
        //Time take in variable for validation end 
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details                 
        inner join users on users.id = roaster_details.user_id
        WHERE `date`= '$date' AND attend_status = 'no' order by alphabet");
        //pr($duty); exit;
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

    function user_status_leave($id, $a) {
        $this->loadModel('RoasterDetail');
        $this->RoasterDetail->id = $id;
        if ($a == 'M') {
            $d = '5:30';
        } elseif ($a == 'A') {
            $d = '8:00';
        } elseif ($a == 'N') {
            $d = '6:00';
        }
        $this->RoasterDetail->saveField("total_duty", $d);
        $this->RoasterDetail->saveField("attend_status", 'approve');
        $this->RoasterDetail->saveField("attend_status", 'leave');
        $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Status change successfully:-) </strong>
		</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('present_roaster');
    }

    function user_status_insert() {
        $this->loadModel('RoasterDetail');
        if ($this->request->is('post')) {
            $this->RoasterDetail->set($this->request->data);
            $status = $this->request->data['RoasterDetail']['attend_status'];
            if ($status == 'absent') {
                $this->request->data['RoasterDetail']['total_duty'] = '00:00:00';
            }
            pr($this->request->data);
            exit;
            $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Status inserted successfully:-) </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('addticketdepartment');
        }
    }

    function requested_approve($id) {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $id = $this->params['pass'][0];
        //data retrive data for update roaster detail table start
        $new_info = $this->User->query("SELECT * FROM users where id = $id");
        $in = $new_info[0]['users']['last_in_time'];
        $shift = $new_info[0]['users']['last_duty_sift'];
        $pc_first_log_info = $new_info[0]['users']['pc_id_user'];
//        $in = '09:20:00pm';
        $in_office = strtotime($in); // last log in time present of office
        $out = $new_info[0]['users']['last_out_time'];
//        $out_office = strtotime($out); // last log in time present of office
        $out_office = strtotime('09:00:00pm'); // last log in time present of office
        $a_status = $new_info[0]['users']['log_status'];

        //data retrive for update roaster detail table end
        //data retrive by date , record id start
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND user_id = $id  order by alphabet");

        #$a_status = $duty[0]['roaster_details']['attend_status'];
        $r_id = $duty[0]['roaster_details']['id'];

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
                pr('one');
                exit;
                $in_office1 = strtotime('+15 minutes', $in_office); // +15 minius for find out late time

                $total_time = ($in_office1 - $f_time) / 60;
                $e_minutes = floor(($total_time / 60) % 60); //h
                $e_seconds = $total_time % 60; //min
                $e_td = $e_minutes . ':' . $e_seconds;
                //pr($e_td.' lat'); exit;
                $this->RoasterDetail->id = $r_id;
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
                $this->RoasterDetail->saveField("extra_time", $e_td);
            }
            //pr('last'); exit;
            $att_status = 'start';
        } elseif ($a_status == 'complete') {
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
            // pr($o_time . ' ' . $out_office);
//            exit;
            if ($in_office <= $f_time && $out_office >= $o_time) { // When an employee come time to time
                //  pr('y'); 
                // $in_office1 = strtotime('+15 minutes', $out_office); // +15 minius for find out late time
//                $total_time = ($out_office - $in_office) / 60;
//                $e_minutes = floor(($total_time / 60) % 60); //h
//                $e_seconds = $total_time % 60; //min
//                $e_td = $e_minutes . ':' . $e_seconds;
                if ($shift == 'Morning (07:30 - 12:00)') {
                    $e_td = '05:30:00';
                } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                    $e_td = '08:00:00';
                } elseif ($shift == 'Night (09:00 - 03:00)') {
                    $e_td = '06:00:00';
                }
                // pr($e_td. ' ' . 'good');
                //  exit;
                $this->RoasterDetail->id = $r_id;
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
                $this->RoasterDetail->saveField("total_duty", $e_td);
            }
            //pr('last 2');
            //exit;
            $att_status = 'approve';
        }

        // update roaster detail start
        $data4rd = array();
        $data4rd['RoasterDetail'] = array(
            'id' => $r_id,
            'in_time' => $in,
            'out_time' => $out,
            'user_login_info' => $pc_first_log_info,
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

    function attend() {
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $loggedUser = $this->Auth->user();
        $u_id = $loggedUser['id'];
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND user_id = $u_id  AND attend_status != 'approve' order by alphabet");
        $this->set(compact('duty'));
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
//            echo $this->RoasterDetail->getLastQuery();
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

    public function logout() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        //$out = date("h:i:s");// out time dynamic
        $out = '03:00:00am'; // out time static
        $id = $this->Auth->user('id');
        $last_in_time = $this->Auth->user('last_in_time');

        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND user_id = $id  order by alphabet");
        $l_in = $duty[0]['roaster_details']['in_time'];

        if ($l_in == '00:00:00') {
            $this->User->id = $id;
            $this->User->saveField("last_out_time", '00:00:00');
        } else {
            $this->User->id = $id;
            $this->User->saveField("last_out_time", $out);
            $this->User->saveField("log_status", "complete");
        }

        $msg = ' <div class="alert alert-success">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>You have successfully logged out</strong> 
                 </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->Auth->logout());
    }

    function dashboard() {
        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
            //  echo 'here'; exit; //(array('action' => 'deshboard'));
        }
    }

    function addrole() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Role->set($this->request->data);
            if ($this->Role->validates()) {
                $loggedUser = $this->Auth->user();
                $data['Role'] = array(
                    "user_id" => $loggedUser['id']);
                $this->Role->save($data);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Role created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addrole');
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editrole() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Role->set($this->request->data);
            if ($this->Role->validates()) {
                $this->Role->id = $this->request->data['Role']['id'];
                $loggedUser = $this->Auth->user();
                $data['Role'] = array("user_id" => $loggedUser['id']);
                $this->Role->save($data);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
        $this->set(compact('roles'));
    }

    function manageRole() {
        $this->loadModel('Role');
        $roles = $this->Role->find('all');
        $this->set(compact('roles'));
    }

    function addticketdepartment() {
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->TicketDepartment->set($this->request->data);
            if ($this->TicketDepartment->validates()) {
                $this->TicketDepartment->save($this->request->data['TicketDepartment']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Added New Department  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addticketdepartment');
            } else {
                $msg = $this->generateError($this->TicketDepartment->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editticketdepartment() {
        $this->loadModel('TicketDepartment');
        if ($this->request->is('post')) {
            $this->TicketDepartment->set($this->request->data);
            if ($this->TicketDepartment->validates()) {
                $this->TicketDepartment->id = $this->request->data['TicketDepartment']['id'];
                $this->TicketDepartment->save($this->request->data['TicketDepartment']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->TicketDepartment->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->TicketDepartment->find('list', array('order' => array('TicketDepartment.name' => 'ASC')));
        $this->set(compact('TicketDepartment'));
        $this->set(compact('roles'));
    }

    function manageticketDepartment() {
        $this->loadModel('TicketDepartment');
        $departments = $this->TicketDepartment->find('all');
        $this->set(compact('departments'));
    }

    function addissue() {
        $this->loadModel('Issue');
        $loggedUser = $this->Auth->user();
        $this->request->data['Issue']['user_id'] = $loggedUser['id'];
        if ($this->request->is('post')) {
            $this->Issue->set($this->request->data);
            if ($this->Issue->validates()) {
                $this->Issue->save($this->request->data['Issue']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Added New Issue </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addissue');
            } else {
                $msg = $this->generateError($this->issue->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editissue() {
        $this->loadModel('Issue');
        if ($this->request->is('post')) {
            $this->Issue->set($this->request->data);
            if ($this->Issue->validates()) {
                $this->Issue->id = $this->request->data['Issue']['id'];
                $this->Issue->save($this->request->data['Issue']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Role edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Issue->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->Issue->find('list', array('order' => array('Issue.name' => 'ASC')));
        $this->set(compact('Issue'));
        $this->set(compact('roles'));
    }

    function manageIssue() {
        $this->loadModel('Issue');
        $issues = $this->Issue->find('all');
        $this->set(compact('issues'));
    }

    function processImg($img) {
        $upload = new Upload($img['picture']);
        $upload->file_new_name_body = time();
        foreach ($this->img_config['picture'] as $key => $value) {
            $upload->$key = $value;
        }
        $upload->process($this->img_config['target_path']['picture']);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            return $this->redirect('create');
        }
        $return['file_dst_name'] = $upload->file_dst_name;
        return $return;
    }

    function create() {
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Log');
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post')) {
            $this->request->data['User']['user_id'] = $loggedUser['id'];
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $result = array();
                if (!empty($this->request->data['User']['picture']['name'])) {
                    $result = $this->processImg($this->request->data['User']);
                    $this->request->data['User']['picture'] = $result['file_dst_name'];
                } else {
                    $this->request->data['User']['picture'] = '';
                }
                $insert_id = $this->User->save($this->request->data['User']);
                if ($insert_id['User']['id'] != '') {// log information  
                    $this->request->data['Log'] = $this->log_info();
                    $this->request->data['Log']['insert_id'] = $insert_id['User']['id'];
                    $this->Log->save($this->request->data['Log']); // log information
                }
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> User Created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('create');
            } else {
                $msg = $this->generateError($this->User->validationErrors);
                $this->Session->setFlash($msg);
            }
        }

        $this->set('roles', $this->Role->find("list"));
    }

    function manage() {
        $this->loadModel('User');
        $agents = $this->User->find('all');
        $this->set(compact('agents'));
    }

    function edit_admin($id = null) {
        $this->loadModel('Role');
        $this->loadModel('User');
        if ($this->request->is('post') || $this->request->is('put')) {
            $loggedUser = $this->Auth->user();
            $this->request->data['User']['user_id'] = $loggedUser['id'];
            $this->User->set($this->request->data);
            $this->User->id = $id;
            $this->User->save($this->request->data['User']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Admin updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        if (!$this->request->data) {
            $data = $this->User->findById($id);
            $this->request->data = $data;
            $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
            $this->set(compact('roles', 'data'));
        }
    }

    function delete($id = null) {
        $this->loadModel('User');
        $this->User->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> User deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function block($id = null) {
        $this->loadModel('User');
        $this->User->id = $id;
        $this->User->saveField("status", "blocked");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> User blocked succeesfully </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function active($id = null) {
        $this->loadModel('User');
        $this->User->id = $id;
        $this->User->saveField("status", "active");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> User activated succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    function getCustomerByParam($param, $field) {
        $param = trim($param);
        //  echo $field.'<br>';
        $param = str_replace(' ', '', $param);
        if ($field == "cell") {
            $param = str_replace('-', '', $param);
            $param = str_replace('(', '', $param);
            $param = str_replace(')', '', $param);
        }

        $condition = "LOWER(package_customers." . $field . ") LIKE '%" . strtolower($param) . "%'";
        $name = array('first_name', 'last_name', 'middle_name');

        if (in_array($field, $name)) {
            $condition = " LOWER(package_customers.first_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.middle_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.last_name) LIKE '%" . strtolower($param) . "%'";
        }
        if ($field == "fm_name") {
            $partialname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.first_name,package_customers.middle_name)) LIKE '%" . $partialname . "%'";
        }
        if ($field == "ml_name") {
            $partialname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.middle_name,package_customers.last_name)) LIKE '%" . $partialname . "%'";
        }
        if ($field == "full_name") {
            $fullname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.first_name,package_customers.middle_name,package_customers.last_name)) LIKE '%" . $fullname . "%'";
        }
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE " . $condition;


        //  echo $sql.'<br><br><br><br>'; 
        $temp = $this->PackageCustomer->query($sql);
        // pr($temp);
        $data = array();
        $customer = array();
        $package = array();
        foreach ($temp as $t) {
            $customer[] = $t['package_customers'];
            if (isset($data['packages']['id'])) {
                $psetting = $data['psettings'];
                $data['packages']['duration'] = $psetting['duration'];
                $data['packages']['charge'] = $psetting['amount'];
                $package[] = $data['packages'];
            }
        }
        $data = array();
        $data['customer'] = $customer;
        $data['package'] = $package;
        return $data;
    }

    function changeservice($id = null) {
        $this->loadModel('PackageCustomer');
        if ($this->request->data['PackageCustomer']['status'] == 'ticket') {
            return $this->redirect('/tickets/create/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'repair') {
            //return $this->redirect('/transactions/expire_customer/' . $this->request->data['PaidCustomer']['id']);
            return $this->redirect('/customers/repair/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'info') {
            //return $this->redirect('/transactions/expire_customer/' . $this->request->data['PaidCustomer']['id']);
            return $this->redirect('/customers/edit/' . $this->request->data['PackageCustomer']['id']);
        }
        if ($this->request->data['PackageCustomer']['status'] == 'history') {
            return $this->redirect('/tickets/customertickethistory/' . $this->request->data['PackageCustomer']['id']);
        }
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
        $this->PackageCustomer->status = $this->request->data['PackageCustomer']['status'];
        $this->PackageCustomer->save($this->request->data['PackageCustomer']);
        return $this->redirect('servicemanage' . DS . $this->request->data['PackageCustomer']['id']);
    }

    function tariffplan() {
        $this->loadModel('Psetting');
        $this->loadModel('Package');
        $sql = "SELECT *  FROM packages
                LEFT JOIN psettings ON packages.id=psettings.package_id ORDER BY packages.id ASC";
        $info = $this->Package->query($sql);

        $filteredPackage = array();
        $unique = array();
        $index = 0;
        foreach ($info as $key => $menu) {
            //pr($menu); exit;
            $pm = $menu['packages']['name'];

            if (isset($unique[$pm])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($menu['psettings']['duration'])) {
                    $temp = array('id' => $menu['psettings']['id'], 'duration' => $menu['psettings']['duration'], 'amount' => $menu['psettings']['amount'], 'offer' => $menu['psettings']['offer']);
                    //pr($temp); exit;
                    $filteredPackage[$index]['psettings'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pm] = 'set';
                $temp = array('name' => $pm, 'id' => $menu['packages']['id']);
                $filteredPackage[$index]['packages'] = $temp;
                if (!empty($menu['psettings']['duration'])) {
                    $temp = array('id' => $menu['psettings']['id'], 'duration' => $menu['psettings']['duration'], 'amount' => $menu['psettings']['amount'], 'offer' => $menu['psettings']['offer']);
                    $filteredPackage[$index]['psettings'][] = $temp;
                }
            }
        }
        $this->set(compact('filteredPackage'));
    }

    public function print_queue() {
        $this->loadModel('PackageCustomer');
        $current_date = date('Y-m-d');
        $future_date = date('Y-m-d', strtotime("+25 days"));
        $expire_customer = $this->PackageCustomer->find('all', array('conditions' => array('exp_date >' => $future_date)));
        $this->set(compact('expire_customer'));
        //pr($expire_customer);exit;
    }

    function pdf() {
        $this->layout = 'blank';
    }

    function contact() {
        
    }

    function done($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;

        $contents = $this->request->data['Package_customer']['content'];

        $content = $this->PackageCustomer->saveField("status", "done");
//        pr($content);
//        exit;
//         $comment['Comment']['content'] = $this->request->data['PackageCustomer']['comments'];
//            $this->Comment->save($comment);
//      $comments['Comment']['content'] = $this->request->data['PackageCustomer']['co']
//        $this->Comment->saveField($comments);

        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('opportunity_followup');
    }

    function ready($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $this->PackageCustomer->saveField("status", "ready");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>  succeesfully Ready </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('opportunity_followup');
    }

    function assignedtotech() {

        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    left join installations ins on ins.package_customer_id = pc.id
                    WHERE ins.status = 'scheduled'  ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;
        //    pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                $temp = array('content' => $data['c'], 'user' => $data['u']);
                $filteredData[$index]['comments'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );
                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }

                if (!empty($data['ins']['id'])) {
                    $filteredData[$index]['ins'] = $data['ins'];
                }

                $filteredData[$index]['comments'] = array();
                $temp = array('content' => $data['c'], 'user' => $data['u']);
                $filteredData[$index]['comments'][] = $temp;
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));

        // pr($filteredData);
        //  exit;

        $this->set(compact('filteredData', 'technician'));
    }

    function donebytech() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
//        $offset = --$page * $this->per_page;
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id                    
                    
                    left join installations ins on ins.package_customer_id = pc.id
                    LEFT JOIN referrals ref on pc.id = ref.referred_for
                    WHERE pc.status = 'done by tech' AND  approved=0 group by pc.id ORDER BY pc.modified desc limit 0,300");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';
                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }

                if (!empty($data['ins']['id'])) {
                    $filteredData[$index]['ins'] = $data['ins'];
                }

                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                $filteredData[$index]['ref'] = $data['ref'];
            }
        }



        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function donebytech_() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
//        $offset = --$page * $this->per_page;
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'done by tech' AND  approved=0 group by pc.id ORDER BY pc.modified desc limit 0,300");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';
                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }



        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function donebyadmin() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'done' AND approved=1");
//        pr($allData); exit;
        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));

//    pr($filteredData); exit;
        $this->set(compact('filteredData', 'technician'));
    }

    function postponebytech() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'post pone' AND approved=0  ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function rescheduledbytech() {

        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'rescheduled' ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;
        // pr($allData); exit;
        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function cancelledbytech() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    WHERE pc.status = 'canceled' AND approved=0 ORDER BY pc.id");

        $filteredData = array();
        $unique = array();
        $index = 0;

        foreach ($allData as $key => $data) {
            //pr($data); exit;
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    //  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    //pr($temp); exit;

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function approved($id = null, $tid = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->PackageCustomer->id = $id;
        $loggedUser = $this->Auth->user();
        //  echo $id.'<br>';
        //  echo $tid;
        $this->PackageCustomer->saveField("approved", "1");
        $this->PackageCustomer->saveField("status", "done");
        $this->PackageCustomer->saveField("ins_by", $tid);
        $pc = $this->PackageCustomer->saveField("user_id", $loggedUser['id']);
        $status = 'sales done';
        $data4statusHistory = array();
        $data4statusHistory['StatusHistory'] = array(
            'package_customer_id' => $pc['PackageCustomer']['id'],
            'date' => date('Y-m-d'),
            'status' => $status
        );

        $this->StatusHistory->save($data4statusHistory);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
        $this->Session->setFlash($msg);
        $temp = $this->PackageCustomer->findById($id);
        $payable_amount = $temp['PackageCustomer']['deposit'] + $temp['PackageCustomer']['monthly_bill'] + $temp['PackageCustomer']['others'];
        $data['Transaction'] = array(
            'package_customer_id' => $id,
            'status' => 'open',
            'payable_amount' => $payable_amount
        );

        // $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function shortApprove($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->PackageCustomer->id = $id;
        $pcid = $this->request->data['Comment']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $comments = $this->request->data['Comment']['comments'];
        $data['PackageCustomer'] = array(
            "id" => $pcid,
            "approved" => "1",
            "status" => "done",
            "comments" => $comments,
            "user_id" => $loggedUser['id']);
        $pc = $this->PackageCustomer->save($data);
        $data4statusHistory = array();
        $data4statusHistory['StatusHistory'] = array(
            'package_customer_id' => $pc['PackageCustomer']['id'],
            'date' => date('Y-m-d'),
            'status' => $this->request->data['Comment']['status']
        );
//        pr($data4statusHistory); exit;
        $this->StatusHistory->save($data4statusHistory);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
        $this->Session->setFlash($msg);
        // $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function pcComment($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $id;
        $pcid = $this->request->data['Comment']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $comments = $this->request->data['Comment']['comments'];

        $data['PackageCustomer'] = array(
            "id" => $pcid,
            "comments" => $comments,
            "user_id" => $loggedUser['id']);
//    pr($data); exit;
        $this->PackageCustomer->save($data);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully commented </strong></div>';
        $this->Session->setFlash($msg);
        // $this->generateInvoice($data);
        return $this->redirect($this->referer());
    }

    function scheduleDone() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data['PackageCustomer']['daterange'])) {
                $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
                $ds = new DateTime($datrange['start']);
                $timestamp = $ds->getTimestamp(); // Unix timestamp
                $startd = $ds->format('m/y'); // 2003-10-16
                $de = new DateTime($datrange['end']);
                $timestamp = $de->getTimestamp(); // Unix timestamp
                $endd = $de->format('m/y'); // 2003-10-16
                $conditions = "";
                if (count($datrange)) {
                    if ($datrange['start'] == $datrange['end']) {
                        $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                        //  convert(varchar(10),pc.schedule_date, 120) = '2014-02-07'
                        //CAST(pc.schedule_date as DATE)
                        $conditions .="ins.date >=' " . $datrange['start'] . "' AND ins.date < '" . $nextday . "'";
                    } else {
                        $conditions .="ins.date >='" . $datrange['start'] . "' AND  ins.date <='" . $datrange['end'] . "'";
                    }
                }
            } else {
                $conditions = "";
                $p_date = '2015-01-01';
                $conditions .="ins.date >='" . $p_date . "'";
            }
            $sql = "SELECT * FROM package_customers pc 
                    left join comments c on pc.id = c.package_customer_id
                    left join users u on c.user_id = u.id
                    left join users ut on pc.technician_id = ut.id
                    left join psettings ps on ps.id = pc.psetting_id
                    left join custom_packages cp on cp.id = pc.custom_package_id 
                    left join issues i on pc.issue_id = i.id
                    left join installations ins on ins.package_customer_id = pc.id
                    WHERE pc.status = 'scheduled' and $conditions ORDER BY pc.id";
            $allData = $this->PackageCustomer->query($sql);

            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$pd] = 'set';

                    $filteredData[$index]['customers'] = $data['pc'];
                    $filteredData[$index]['users'] = $data['u'];
                    $filteredData[$index]['tech'] = $data['ut'];

                    $filteredData[$index]['package'] = array(
                        'name' => 'No package dealings',
                        'duration' => 'Not Applicable',
                        'amount' => 'not Applicable'
                    );
                    if (!empty($data['i']['id'])) {
                        $filteredData[$index]['issue'] = $data['i'];
                    }

                    if (!empty($data['ps']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['ps']['name'],
                            'duration' => $data['ps']['duration'],
                            'amount' => $data['ps']['amount']
                        );
                    }
                    if (!empty($data['cp']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['cp']['duration'] . ' months custom package',
                            'duration' => $data['cp']['duration'],
                            'amount' => $data['cp']['charge']
                        );
                    }

                    if (!empty($data['ins']['id'])) {
                        $filteredData[$index]['ins'] = $data['ins'];
                    }


                    $filteredData[$index]['comments'] = array();
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
            $clicked = true;
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function changePassword() {
        $this->loadModel('Role');
        $this->loadModel('User');


        if ($this->request->is('post') || $this->request->is('put')) {
            $loggedUser = $this->Auth->user();

            $user = $this->User->findById($loggedUser['id']);
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $givenPass = $passwordHasher->hash(
                    $this->request->data['User']['old_password']
            );
            if ($givenPass == $user['User']['password']) {
                unset($this->User->validate['email']);
                $this->User->id = $loggedUser['id'];
                $this->User->save($this->request->data['User']);
                $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Password updated succeesfully </strong>
	</div>';
            } else {
                $msg = '<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Old password is wrong</strong>
	</div>';
            }
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function adjustmentMemo() {
        $this->loadModel('Transaction');
        $sql = "SELECT * FROM transactions " .
                "LEFT JOIN package_customers ON package_customers.id = transactions.package_customer_id " .
                "WHERE LOWER(transactions.status) IN ('credit','sdadjustment','sdrefund','referralbonus')";
        $data = $this->Transaction->query($sql);
        $this->set(compact('data'));
    }

    function deleteMemo($id = null) {
        $this->loadModel('Transaction');
        $this->Transaction->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Memo deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('adjustmentMemo');
    }

    function approveMemo($id = null) {
        $this->loadModel('Transaction');
        $this->Transaction->id = $id;
        $loggedUser = $this->Auth->user();

        $this->Transaction->saveField("status", "approved");
        $this->Transaction->saveField("user_id", $loggedUser['id']);

        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';

        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function approveReferral($id = null) {
        $this->loadModel('Transaction');
        $this->loadModel('Referral');

        $loggedUser = $this->Auth->user();
        $bonus_for = $this->params['pass']['0'];
        $tr_info = $this->Transaction->find('all', array('conditions' => array('Transaction.status' => 'referral_bonus', 'Transaction.bonus_for' => $bonus_for)));
        $new_pc_id = $tr_info[0]['Transaction']['bonus_for'];
        $pc_info = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.id' => $new_pc_id)));

        if ($pc_info[0]['PackageCustomer']['mac_status'] == 'Active') {
            $this->request->data['Transaction']['id'] = $tr_info[0]['Transaction']['id'];
            $this->request->data['Transaction']['status'] = 'approved';
            $this->request->data['Transaction']['user_id'] = $loggedUser['id'];

            $referralData['Referral'] = array(
                'id' => $this->params['pass'][1],
                'status' => 'approved',
                'user_id' => $loggedUser['id'],
            );
            $this->Referral->save($referralData);
            $this->Transaction->save($this->request->data['Transaction']);
            $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully approved </strong></div>';
            $this->Session->setFlash($msg);
        } else {
            $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Sorry this customer not active now!!! </strong></div>';
            $this->Session->setFlash($msg);
        }
        return $this->redirect($this->referer());
    }

    function runReport() {
        $this->sendReport();
        return $this->redirect('/customers/search');
    }

    function script() {
        
    }

    function data_transfer() {
        $this->loadModel('MacHistory');
        $this->loadModel('StatusHistory');
        //slect last mac info of a customer for update macHistory table
        $data = $this->StatusHistory->query("SELECT * FROM `status_histories` WHERE modified BETWEEN '2017-10-21 23:59:59' AND '2017-10-25 23:59:59' AND log_user_id >0");

        foreach ($data as $results) {
            $result = $results['status_histories'];
            $data_mac_history = array(
                'user_id' => $result['log_user_id'],
                'package_customer_id' => $result['package_customer_id'],
                'mac' => $result['mac'],
                'system' => $result['system'],
                'installed_by' => $result['user_id'],
                'installation_date' => $result['date'],
                'status' => $result['status']
            );
            $this->MacHistory->create();
            $this->MacHistory->save($data_mac_history);
        }
        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Transfer successfully! </strong>
        </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function data_transfer_id_wise() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('BackupPackageCustomer');
        $this->loadModel('Log');
        //slect last mac info of a customer for update macHistory table
        $id = $this->request->data['PackageCustomer']['id'];
        $data = $this->BackupPackageCustomer->query("SELECT * FROM `backup_package_customers` WHERE id = $id");
//        pr($data); exit;
        $this->PackageCustomer->save($data[0]['backup_package_customers']);
        $this->Log->save($this->log_info());
        $this->BackupPackageCustomer->delete($id);
        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>PC data transfer successfully :-) </strong>
        </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function ref_bonus() {
        $this->loadModel('Referral');
        $loggedUser = $this->Auth->user();
        $role4ref = $loggedUser['Role']['name'];
        $ref = $this->Referral->query("select * from referrals
                LEFT JOIN package_customers on referrals.referred_for = package_customers.id 
                where referrals.verified_by ='si' AND referrals.status !='approved' AND referrals.status !='canceled'  AND package_customers.installation_date != '0000-00-00'");
        $this->set(compact('role4ref', 'ref'));
    }

    function ref_hold_canceled_back() {
        $this->loadModel('Referral');
        $loggedUser = $this->Auth->user();
        $role4ref = $loggedUser['Role']['name'];
        $ref = $this->Referral->query("select * from referrals
                LEFT JOIN package_customers on referrals.referred_for = package_customers.id 
                where referrals.verified_by ='si' AND referrals.status !='approved' AND referrals.status !='canceled'  AND package_customers.installation_date != '0000-00-00'");
        $this->set(compact('role4ref', 'ref'));
    }

    function ref_modify() {
        $this->loadModel('Referral');
        $ref_c = $this->request->data['ReferralChange']['ref_cell'];
        $loggedUser = $this->Auth->user();
        $id = $this->request->data['ReferralChange']['id'];
        $bonus = $this->request->data['ReferralChange']['bonus'];
        $cell_idq = $this->PackageCustomer->query("SELECT * FROM package_customers where cell = $ref_c"); //search & take data by cell no for referral table
        // insert data Referral start
        $data4reffral = array();
        $data4reffral['Referral'] = array(
            'id' => $id,
            'user_id' => $loggedUser['id'],
            'package_customer_id' => $cell_idq[0]['package_customers']['id'], //old customer                
            'ref_name' => $cell_idq[0]['package_customers']['first_name'] . ' ' . $cell_idq[0]['package_customers']['middle_name'] . ' ' . $cell_idq[0]['package_customers']['last_name'], //old customer                
            'ref_cell' => $cell_idq[0]['package_customers']['cell'], //old customer              
            'bonus' => $bonus
        );

        $this->Referral->save($data4reffral);
        // insert data Referral end
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> Update hasbeen succeesful </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('ref_bonus');
    }

    function ref_canceled($id = null) {
        $this->loadModel('Referral');
        $this->Referral->id = $id;
        $this->Referral->saveField("status", "canceled");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Referral bonus canceled succeesfully </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('ref_bonus');
    }

    function adddesignation() {
        $this->loadModel('Designation');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Designation->set($this->request->data);
            if ($this->Designation->validates()) {
                $this->Designation->save($this->request->data['Designation']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Designation inserted succeesfully  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('adddesignation');
            } else {
                $msg = $this->generateError($this->Designation->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editdesignation() {
        $this->loadModel('Designation');
        if ($this->request->is('post')) {
            $this->Designation->set($this->request->data);
            if ($this->Designation->validates()) {
                $this->Designation->id = $this->request->data['Designation']['id'];
                $this->Designation->save($this->request->data['Designation']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Designation edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Designation->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $designations = $this->Designation->find('list', array('order' => array('Designation.name' => 'ASC')));
        $this->set(compact('designations'));
    }

    function managedesignation() {
        $this->loadModel('Designation');
        $designations = $this->Designation->find('all');
        $this->set(compact('designations'));
    }

    function addcity() {
        $this->loadModel('City');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->City->set($this->request->data);
            if ($this->City->validates()) {
                $this->request->data['City']['user_id'] = $loggedUser['id'];
                $this->request->data['City']['pc_id'] = $pc_info;
                $this->City->save($this->request->data['City']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> City inserted succeesfully  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('addcity');
            } else {
                $msg = $this->generateError($this->City->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editcity() {
        $this->loadModel('City');
        if ($this->request->is('post')) {
            $this->City->set($this->request->data);
            if ($this->City->validates()) {
                $this->City->id = $this->request->data['City']['id'];
                $this->City->save($this->request->data['City']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> City edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->City->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $cities = $this->City->find('list', array('order' => array('City.name' => 'ASC')));
        $this->set(compact('cities'));
    }

    function managecity() {
        $this->loadModel('City');
        $cities = $this->City->find('all');
        $this->set(compact('cities'));
    }

    function adddepartment() {
        $this->loadModel('Department');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        if ($this->request->is('post')) {
            $this->Department->set($this->request->data);
            if ($this->Department->validates()) {
                $this->request->data['Department']['user_id'] = $loggedUser['id'];
                $this->request->data['Department']['pc_id'] = $pc_info;
                $this->Department->save($this->request->data['Department']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Added New Department  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('adddepartment');
            } else {
                $msg = $this->generateError($this->Department->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function editdepartment() {
        $this->loadModel('Department');
        if ($this->request->is('post')) {
            $this->Department->set($this->request->data);
            if ($this->Department->validates()) {
                $this->Department->id = $this->request->data['Department']['id'];
                $this->Department->save($this->request->data['Department']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Department edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Department->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $departments = $this->Department->find('list', array('order' => array('Department.name' => 'ASC')));
        $this->set(compact('departments'));
    }

    function managedepartment() {
        $this->loadModel('Department');
        $departments = $this->Department->find('all');
        $this->set(compact('departments'));
    }

}

?>