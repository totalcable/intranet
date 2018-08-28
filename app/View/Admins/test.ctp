                        <?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Controller', 'Transactions'); // mention at top
App::import('Controller', 'Payments');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

class AdminsController extends AppController {
//                                            //in time start
//                                            $dd = strtotime($agent['last_in_time']);
//                                            $dd1 = date("h:i", $dd);
//                                            // in time end
//                                            //pr($fix_time);
//                                            if ($fix_time = 'Morning (07:30 - 12:00)') {
//
//                                                $s_time = substr($fix_time, 9, 5); //fix time  
//                                                
//                                            } elseif ($fix_time = 'Afternoon (12:00 - 08:00)') {
//                                                //pr('po'); exit;
//                                                $s_time = substr($fix_time, 19, -1); //fix time 
//                                            } elseif ($fix_time = 'Night(08:00 - 02:00') {
//                                                $fix_time = $agent[0]['users']['last_duty_sift'];
//                                                $s_time = substr($fix_time, 13, -1); //fix time 
//                                            }
//                                            //$late = $dd1 - $s_time;
//                                            $late = strtotime($dd1) - strtotime($s_time);
//                                            $m_time1 = $late / 60;
//
//
//
//                                            $init = $m_time1;
//                                            //$hours = floor($init / 3600);
//                                            $minutes = floor(($init / 60) % 60);
//                                            $seconds = $init % 60;
//
//                                         
//                                            


//extra time find

//Extra time finding start
//        $new_info = $this->User->query("SELECT * FROM users where id = $id");       
//        $fix_time = $new_info[0]['users']['last_duty_sift'];
//        //pr($fix_time); exit;
//        $in = $new_info[0]['users']['last_in_time'];
//      
//        //data retrive for update roaster detail table end
//        //Late time count start
//        //in time start
//        $dd = strtotime($in);
//        $dd1 = date("h:i", $dd);
//        // in time end
//        if ($fix_time = 'Morning (07:30 - 12:00)') {
//            $s_time = substr($fix_time, 9, 5); //fix time  
//        } elseif ($fix_time = 'Afternoon (12:00 - 08:00)') {
//            $s_time = substr($fix_time, 19, -1); //fix time 
//        } elseif ($fix_time = 'Night(08:00 - 02:00') {
//            $fix_time = $agent[0]['users']['last_duty_sift'];
//            $s_time = substr($fix_time, 13, -1); //fix time 
//        }
//        // who many time rule play in office start
//               // $in = $duty[0]['roaster_details']['in_time'];
//                //in time start
//                $dd = strtotime($in);// in time
//                $dd1 = date("h:i", $dd);// out time
//
//                $late = strtotime($out) - strtotime($dd1);
//                $m_time1 = $late / 60;
//                $init = $m_time1;
//                //$hours = floor($init / 3600);
//                $minutes = floor(($init / 60) % 60 + 1);
//                $seconds = $init % 60;
//                $td = $minutes . ':' . $seconds;
//        
//        pr($s_time) ;
        
        
        //10-08-2018
        
        function requested_approve($id) {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $id = $this->params['pass'][0];

        //data retrive for update roaster detail table start
        $new_info = $this->User->query("SELECT * FROM users where id = $id");
        $emp_id = $new_info[0]['users']['emp_id'];
        $l_date = $new_info[0]['users']['last_duty_date'];
        $fix_time = $new_info[0]['users']['last_duty_sift'];
        //pr($fix_time); exit;
        $in = $new_info[0]['users']['last_in_time'];
        $out = $new_info[0]['users']['last_out_time'];
        //data retrive for update roaster detail table end
        //Late time count start
        //in time start
        $dd = strtotime($in);
        $dd1 = date("h:i", $dd);
        // in time end
        if ($fix_time = 'Morning (07:30 - 12:00)') {
            $s_time = substr($fix_time, 9, 5); //fix time  
        } elseif ($fix_time = 'Afternoon (12:00 - 08:00)') {
            $s_time = substr($fix_time, 19, -1); //fix time 
        } elseif ($fix_time = 'Night(08:00 - 02:00') {
            $fix_time = $agent[0]['users']['last_duty_sift'];
            $s_time = substr($fix_time, 13, -1); //fix time 
        }
        //$late = $dd1 - $s_time;
        $res = strtotime($dd1) - strtotime($s_time);

        $m_time1 = $res / 60;
        $init = $m_time1;
//        $hours = floor($init / 3600);
        $hours = floor($init / 60);
        $minutes = floor(($init / 60) % 60);
        $seconds = $init % 60;

        if (!empty($hours) || !empty($minutes) || !empty($seconds)) {
            $late = $minutes . ':' . $seconds;
        } else {
            $late = '0:0';
        }
        //Late time count end
        //data retrive by date , record id start
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND emp_id = $id  order by alphabet");
        $shift = $duty[0]['roaster_details']['shift_name_time'];
        $a_status = $duty[0]['roaster_details']['attend_status'];
        $r_id = $duty[0]['roaster_details']['id'];
        //data retrive by date , record id end

        if ($a_status == 'request') {
            $att_status = 'start';
        } elseif ($a_status == 'complete') {
            $att_status = 'approve';
        }

        // update roaster detail start
        $data4rd = array();
        $data4rd['RoasterDetail'] = array(
            'id' => $r_id,
            //'emp_id' => $emp_id,
            'date' => $l_date,
            'in_time' => $in,
            'late_time' => $late,
            'out_time' => $out,
            'attend_status' => $att_status
        );
        // pr($data4rd); exit;
        $this->RoasterDetail->save($data4rd);
        // update roaster detail end
        // user table update start
        $this->User->id = $id;
        $this->User->saveField("log_status", "no");
        //user table update end
        //user table update start
        if ($a_status == 'complete') {
            $this->User->id = $id;
            $this->User->saveField("last_duty_date", "0000-00-00");
            $this->User->saveField("last_in_time", "00:00:00");
            //$this->User->saveField("late_time", $late);
            $this->User->saveField("last_out_time", "00:00:00");
            $this->User->saveField("last_duty_sift", "");
        }
        //user table update end

        $msg = '<div class="alert alert-successful">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong> Approved</strong>
                        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
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
                    //Find out updateable data from roaster detail table
                    $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND emp_id = $u_id  AND attend_status != 'approve' order by alphabet");
                    //pr($duty); exit;
                    //$shift = $duty[0]['roaster_details']['shift_name_time'];
                    if (!empty($duty[0]['roaster_details']['shift_name_time'])) {

                        // This code check user login time compare with shift in time (15 min + -) start
                        // $fix_time = $duty[0]['roaster_details']['shift_name_time'];//dynamic data
                        $fix_time = 'Morning (07:30 - 12:00)'; //static data
                        //Time take in variable for validation start
                        if ($fix_time == 'Morning (07:30 - 12:00)') {
                            // pr($fix_time); exit;
                            $time = substr($fix_time, 9, 5); //Take in time in variable

                            if ($time == '07:30') {
                                //$pc_time = date("h:i"); //dynamic
                                $pc_time = '11:59'; //static
                                $f_time = '06:45';
                                $l_time = '12:00';
                            }
                            if ($pc_time >= $f_time && $pc_time <= $l_time) { // duty start and end time
                                $shift = $duty[0]['roaster_details']['shift_name_time'];
                                $shift_id = $duty[0]['roaster_details']['id'];
                                if (!empty($loggedUser['last_duty_date'])) {
                                    $inserted_date = $loggedUser['last_duty_date'];
                                    if ($inserted_date != $date) {

                                        //User table update start
                                        $id = $this->Auth->user('id');
                                        $this->request->data['User']['last_duty_date'] = $date;
                                        $this->request->data['User']['last_in_time'] = $in;
                                        $this->request->data['User']['last_duty_sift'] = $shift;
                                        $this->request->data['User']['log_status'] = 'request';
                                        $this->User->id = $id;
                                        $this->User->save($this->request->data['User']);
                                        //User table update end
                                        //RoasterDetail table update start
                                        $this->RoasterDetail->id = $shift_id;
                                        $this->RoasterDetail->saveField("in_time", $in);
                                        $this->RoasterDetail->saveField("attend_status", "request");
                                        //RoasterDetail table update end
                                    }
                                }
                            }
                        } elseif ($fix_time == 'Afternoon (12:00 - 08:00)') {
                            $time = substr($fix_time, 11, 5); //Take in time in variable
                            if ($time == '12:00') {
                                $pc_time = date("h:i");
                                //$pc_time = '11:45';//static
                                $f_time = '11:45';
                                $l_time = '08:00';
                            }
                            if ($pc_time >= $f_time || $pc_time <= $l_time) {
                                $shift = $duty[0]['roaster_details']['shift_name_time'];
                                $shift_id = $duty[0]['roaster_details']['id'];
                                if (!empty($loggedUser['last_duty_date'])) {
                                    //pr('Yes here :-)'); exit;
                                    $inserted_date = $loggedUser['last_duty_date'];
                                    if ($inserted_date != $date) {

                                        //User table update start
                                        $id = $this->Auth->user('id');
                                        $this->request->data['User']['last_duty_date'] = $date;
                                        $this->request->data['User']['last_in_time'] = $in;
                                        $this->request->data['User']['last_duty_sift'] = $shift;
                                        $this->request->data['User']['log_status'] = 'request';
                                        $this->User->id = $id;
                                        $this->User->save($this->request->data['User']);
                                        //User table update end
                                        //RoasterDetail table update start
                                        $this->RoasterDetail->id = $shift_id;
                                        $this->RoasterDetail->saveField("in_time", $in);
                                        $this->RoasterDetail->saveField("attend_status", "request");
                                        //RoasterDetail table update end
                                    }
                                }
                            }
                            // pr('Task End'); exit; 
                            //  $fix_time = $agent[0]['users']['last_duty_sift'];
                            //$s_time = substr($fix_time, 19, -1); //fix time 
                        } elseif ($fix_time == 'Night(08:00 - 02:00)') {
                            //pr($fix_time); exit;
                            $time = substr($fix_time, 6, 5); //Take in time in variable
                            // pr($time); exit;
                            if ($time == '08:00') {
                                //$pc_time = date("h:i");
                                $pc_time = '07:55'; //static
                                $f_time = '07:45';
                                $l_time = '02:00';
                            }
                            // pr($f_time.' '.$l_time.' '.$pc_time); exit; 
                            if ($pc_time >= $f_time || $pc_time <= $l_time) {
                                $shift = $duty[0]['roaster_details']['shift_name_time'];
                                $shift_id = $duty[0]['roaster_details']['id'];
                                if (!empty($loggedUser['last_duty_date'])) {
                                    //pr('Yes here :-)'); exit;
                                    $inserted_date = $loggedUser['last_duty_date'];
                                    if ($inserted_date != $date) {

                                        //User table update start
                                        $id = $this->Auth->user('id');
                                        $this->request->data['User']['last_duty_date'] = $date;
                                        $this->request->data['User']['last_in_time'] = $in;
                                        $this->request->data['User']['last_duty_sift'] = $shift;
                                        $this->request->data['User']['log_status'] = 'request';
                                        $this->User->id = $id;
                                        $this->User->save($this->request->data['User']);
                                        //User table update end
                                        //RoasterDetail table update start
                                        $this->RoasterDetail->id = $shift_id;
                                        $this->RoasterDetail->saveField("in_time", $in);
                                        $this->RoasterDetail->saveField("attend_status", "request");
                                        //RoasterDetail table update end
                                    }
                                }
                            }
                            // $fix_time = $agent[0]['users']['last_duty_sift'];
                            // $s_time = substr($fix_time, 13, -1); //fix time 
                        }
                        // This code check user login time compare with shift in time (15 min + -) start
                        //Time take in variable for validation end  
                        // pr('Task End'); exit; 
                    }

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
    
    }
    
    
   //15-08-2018 
    
      $f_time = strtotime('07:30:00am'); // fix office in time
                $total_late_time = ($in_office - $f_time); // fixt office in time
               
                $in_office1 = strtotime('-15 minutes', $out_office); // -15 minius for find out extra time
               pr($in_office1.' >'.$out_office.'pp'); 
                $total_time = (($in_office1-$total_late_time) - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60)+1;
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;
                
                 pr($e_td); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("total_duty", $e_td);
    
//    done for morning
                
                function requested_approve($id) {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $id = $this->params['pass'][0];
        //data retrive data for update roaster detail table start
        $new_info = $this->User->query("SELECT * FROM users where id = $id");
        $in = $new_info[0]['users']['last_in_time'];
        $shift = $new_info[0]['users']['last_duty_sift'];
        $in = '12:45:00pm';
        $in_office = strtotime($in); // last log in time present of office
        $out = $new_info[0]['users']['last_out_time'];
//        $out_office = strtotime($out); // last log in time present of office
        $out_office = strtotime('01:00:00pm'); // last log in time present of office
        $a_status = $new_info[0]['users']['log_status'];

        //data retrive for update roaster detail table end
        //data retrive by date , record id start
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND emp_id = $id  order by alphabet");

        #$a_status = $duty[0]['roaster_details']['attend_status'];
        $r_id = $duty[0]['roaster_details']['id'];

        if ($a_status == 'request') {
            $f_time = strtotime('07:45:00am'); // fix office time
            

            if ($in_office > $f_time) { //for late time
                pr('He'); exit;
                $in_office1 = strtotime('+15 minutes', $in_office); // +15 minius for find out late time
                $total_time = ($in_office1 - $f_time) / 60;
                $e_minutes = floor(($total_time / 60) % 60); //h
                $e_seconds = $total_time % 60; //min
                $e_td = $e_minutes . ':' . $e_seconds;
                //pr($e_td); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("late_time", $e_td);
            } elseif ($f_time > $in_office) {//for extra time
                $in_office1 = strtotime('-15 minutes', $f_time); // -15 minius for find out extra time
                $total_time = ($in_office1 - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60);
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;
                //pr($e_td); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("extra_time", $e_td);
            }
            $att_status = 'start';
        } elseif ($a_status == 'complete') {
            $f_time = strtotime('07:45:00am'); // fixt office in time
            $o_time = strtotime('01:00:00pm'); // fixt office out time
            pr($o_time.' '.$out_office); exit;
            if ($in_office <= $f_time && $out_office >= $o_time) { // When an employee come time to time
                //pr('y'); exit;
                $in_office1 = strtotime('+15 minutes', $out_office); // +15 minius for find out late time
                $total_time = ($in_office1 - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60); //h
                $e_seconds = $total_time % 60; //min
                $e_td = $e_minutes . ':' . $e_seconds;
                //pr($e_td.' '.'kk'); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("total_duty", $e_td);
            } elseif ($in_office >= $f_time) {//// When an employee come late
                //$f_time = strtotime('07:30:00am'); // fix office in time
                //$total_late_time = ($in_office - $f_time); // fixt office in time
                //$in_office1 = strtotime('-15 minutes', $out_office); // -15 minius for find out extra time
                //pr($in_office1.' >'.$out_office.'pp'); 
                $total_time = ($out_office - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60);
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;

                //pr($e_td); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("total_duty", $e_td);
            }
            //pr('n'); exit;
            $att_status = 'approve';
        }

        // update roaster detail start
        $data4rd = array();
        $data4rd['RoasterDetail'] = array(
            'id' => $r_id,
            'in_time' => $in,
            'out_time' => $out,
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
    
    // when afternoon complete
    
    function requested_approve($id) {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $date = date("Y-m-d");
        $id = $this->params['pass'][0];
        //data retrive data for update roaster detail table start
        $new_info = $this->User->query("SELECT * FROM users where id = $id");
        $in = $new_info[0]['users']['last_in_time'];
        $shift = $new_info[0]['users']['last_duty_sift'];
       // $in = '01:01:00pm';
        $in_office = strtotime($in); // last log in time present of office
        $out = $new_info[0]['users']['last_out_time'];
//        $out_office = strtotime($out); // last log in time present of office
        $out_office = strtotime('09:00:00pm'); // last log in time present of office
        $a_status = $new_info[0]['users']['log_status'];

        //data retrive for update roaster detail table end
        //data retrive by date , record id start
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND emp_id = $id  order by alphabet");

        #$a_status = $duty[0]['roaster_details']['attend_status'];
        $r_id = $duty[0]['roaster_details']['id'];

        if ($a_status == 'request') {

            //Shift name set
            if ($shift == 'Morning (07:30 - 12:00)') {
                $f_time = strtotime('07:45:00am'); // fix office time
            } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                $f_time = strtotime('01:15:00pm'); // fix office time
            } elseif ($shift == 'Night (09:00-02:00)') {
                $f_time = strtotime('09:15:00pm'); // fix office time
            }
            //pr($in_office.'I f '.$f_time);

            if ($in_office > $f_time) { //for late time
                //pr('He'); exit;
                $in_office1 = strtotime('+15 minutes', $in_office); // +15 minius for find out late time

                $total_time = ($in_office1 - $f_time) / 60;
                $e_minutes = floor(($total_time / 60) % 60); //h
                $e_seconds = $total_time % 60; //min
                $e_td = $e_minutes . ':' . $e_seconds;
                // pr($e_td.' lat'); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("late_time", $e_td);
            } elseif ($f_time > $in_office) {//for extra time
                $in_office1 = strtotime('-15 minutes', $f_time); // -15 minius for find out extra time
                $total_time = ($in_office1 - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60);
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;
                $minus = substr($e_td, 2, 1); // find minus 
                if ($minus == '-') {
                    $e_td = '00:00:00';
                }
                // pr($e_td.'  ext'.' '.$minus); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("extra_time", $e_td);
            }
            //pr('last'); exit;
            $att_status = 'start';
        } elseif ($a_status == 'complete') {
            //Shift name set
            if ($shift == 'Morning (07:30 - 12:00)') {
                $f_time = strtotime('07:45:00am'); // fixt office in time
                $o_time = strtotime('01:00:00pm'); // fixt office out time
            } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                $f_time = strtotime('01:15:00pm'); // fix office time
                $o_time = strtotime('09:00:00pm'); // fixt office out time
            } elseif ($shift == 'Night (09:00-02:00)') {
                $f_time = strtotime('09:15:00pm'); // fix office time
                $o_time = strtotime('03:00:00am'); // fixt office out time
            }
//            pr($o_time . ' ' . $out_office);
//            exit;
            if ($in_office <= $f_time && $out_office >= $o_time) { // When an employee come time to time
                //pr('y'); 
                // $in_office1 = strtotime('+15 minutes', $out_office); // +15 minius for find out late time
//                $total_time = ($out_office - $in_office) / 60;
//                $e_minutes = floor(($total_time / 60) % 60); //h
//                $e_seconds = $total_time % 60; //min
//                $e_td = $e_minutes . ':' . $e_seconds;
                if ($shift == 'Morning (07:30 - 12:00)') {
                    $e_td = '05:30:00';
                } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                     $e_td = '08:00:00';
                } elseif ($shift == 'Night (09:00-02:00)') {
                     $e_td = '06:00:00';
                }
                //pr($e_td. ' ' . 'good');
               // exit;

                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("total_duty", $e_td);
            } elseif ($in_office >= $f_time) {//// When an employee come late
                //$f_time = strtotime('07:30:00am'); // fix office in time
                //$total_late_time = ($in_office - $f_time); // fixt office in time
                //$in_office1 = strtotime('-15 minutes', $out_office); // -15 minius for find out extra time
                //pr($in_office . ' >' . $out_office . 'pp');
                $total_time = ($out_office - $in_office) / 60;
                $e_minutes = floor(($total_time / 60) % 60);
                $e_seconds = $total_time % 60;
                $e_td = $e_minutes . ':' . $e_seconds;

               // pr($e_td.' last'); exit;
                $this->RoasterDetail->id = $r_id;
                $this->RoasterDetail->saveField("total_duty", $e_td);
            }
           // pr('last 2');
            //exit;
            $att_status = 'approve';
        }

        // update roaster detail start
        $data4rd = array();
        $data4rd['RoasterDetail'] = array(
            'id' => $r_id,
            'in_time' => $in,
            'out_time' => $out,
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
    
    
    
    
    

?>