<?php

//09-09-2018

 function newcustomers($page, $start, $end) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $offset = --$page * $this->per_page;
        $conditions = 'status_histories.status ="sales done" AND status_histories.date >="' . $start .
                '" AND status_histories.date <="' . $end . '"';
        $sql = "SELECT * FROM package_customers pc                
            LEFT JOIN status_histories ON pc.id = status_histories.package_customer_id           
            left join transactions tr on pc.id = tr.package_customer_id    
            left join psettings ps on ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            LEFT JOIN custom_packages cp  ON cp.id = pc.custom_package_id";

        $sql .=" WHERE " . $conditions;

        $sql .= " GROUP BY status_histories.package_customer_id order by status_histories.id desc limit 0,200";
        $customers = $this->PackageCustomer->query($sql);
        
        $temp = $this->PackageCustomer->query("SELECT COUNT(pc.id) as total FROM package_customers pc                
            LEFT JOIN status_histories ON pc.id = status_histories.package_customer_id           
            left join transactions tr ON pc.id = tr.package_customer_id    
            left join psettings ps ON ps.id = pc.psetting_id
            LEFT JOIN packages p ON p.id = ps.package_id 
            LEFT JOIN custom_packages cp  ON cp.id = pc.custom_package_id WHERE $conditions");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);
      
        $this->set(compact('total_page'));
        $return['total'] = $total_page;
        return $customers;
    }



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


 

function login() {
        $this->loadModel('User');
        $this->layout = "admin-login";
        $payment = new PaymentsController();
        //  $payment->auto_recurring_invoice();
        // $payment->auto_recurring_payment();
        // if already logged in check this step
        if ($this->Auth->loggedIn()) {
            return $this->redirect('dashboard'); //(array('action' => 'deshboard'));
        }
        // after submit login form check this step
        if ($this->request->is('post')) {


            if ($this->Auth->login()) {
                // pr($this->Auth); exit;
                if ($this->Auth->user('status') == 'active') {
                    // user is activated
                    $pic = $this->Auth->user('picture');

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

    public function logout() {
        $msg = ' <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>You have successfully logged out</strong> 
                            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->Auth->logout());
    }
    
    //13-08-2018
    
    $last_in_time = $this->Auth->user('last_in_time');

        //extra time set start
        $new_info = $this->User->query("SELECT * FROM users where id = $id");
        $fix_time = $new_info[0]['users']['last_duty_sift'];
        $in = $new_info[0]['users']['last_in_time'];
       
       // in time end
        if ($fix_time = 'Morning (07:45 - 01:00)') { //accorate time is 07:30 am
            $s_time = substr($fix_time, 9, 5); //fix time  
        } elseif ($fix_time = 'Afternoon (12:45 - 09:00)') { //accorate time is 01:00 am
            $s_time = substr($fix_time, 11, 5); //fix time 
        } elseif ($fix_time = 'Night(08:45 - 03:00') { //accorate time is 09:00 am
            //$fix_time = $agent[0]['users']['last_duty_sift'];
            $s_time = substr($fix_time, 7, 5); //fix time 
        }
        $e_dd = strtotime($in); // in time
        $e_dd1 = date("h:i", $e_dd);
        $e_time = strtotime($s_time) - strtotime($e_dd1);
      
        $e_m_time1 = $e_time / 60;
        $e_init = $e_m_time1;
        //$hours = floor($init / 3600);
        $e_minutes = floor(($e_init / 60) % 60);
        $e_seconds = $e_init % 60;
        $e_td = $e_minutes . ':' . $e_seconds;
        $s_minush = substr($e_td, 0, 1);
        $s_minusm = substr($e_td, 2, 2);
        if (($s_minush = 0 && $s_minusm < 1)) {
            $e_td = '00:00:00';
        } elseif ($s_minush = '-' && $s_minusm < 1) {
            $e_td = '00:00:00';
//        } elseif ($s_minusm = '-' && $s_minusm < 1) {
//            $e_td = '00:00:00';            
        } else {          
            $e_td = $e_td;
        }

        //extra time set end
        
            //data find out without approve,request start
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` = '$date' AND emp_id = $id  AND (attend_status = 'start' AND attend_status != 'complete') order by alphabet");

        if (!empty($duty)) {
            if ($duty[0]['roaster_details']['alphabet'] == 'A') { // Total duty
                $d = '5:30'; //duty
                // who many time rule play in office start
                $in = $duty[0]['roaster_details']['in_time'];
                //in time start
                $dd = strtotime($in); // in time
                $dd1 = date("h:i", $dd);

                $late = strtotime($out) - strtotime($dd1);
                $m_time1 = $late / 60;
                $init = $m_time1;
                //$hours = floor($init / 3600);
                $minutes = floor(($init / 60) % 60 + 1);
                $seconds = $init % 60;
                $td = $minutes . ':' . $seconds;
                // end
//                  pr($td);
//                exit;
                // find out total duty start
//                $dd33 = strtotime($td);
//                $dd11 = date("h:i", $dd33);
//                $late1 = strtotime($d) - strtotime($dd11);
//                $m_time11 = $late1 / 60;
//                $minutes1 = floor(($m_time11 / 60) % 60);
//                $seconds1 = $m_time11 % 60;
//                $total_duty = $minutes1 . ':' . $seconds1;
//                pr($total_duty);
//                exit;
            } elseif ($duty[0]['roaster_details']['alphabet'] == 'B') {
                $d = '8:00'; //duty
            } elseif ($duty[0]['roaster_details']['alphabet'] == 'C') {
                $d = '6:00'; //duty
            }
            //pr($e_td); exit;
            //Extra time finding end

            $shift_id = $duty[0]['roaster_details']['id'];
            if ($last_in_time = '00:00:00') {
                //User table update
                $this->User->id = $id;
                $this->User->saveField("last_out_time", $out);
                $this->User->saveField("log_status", "complete");
//pr($e_td.' '.$s_time.' '.$in); exit;
                //RoasterDetail table update
                $this->RoasterDetail->id = $shift_id;
                $this->RoasterDetail->saveField("total_duty", $td);
                $this->RoasterDetail->saveField("extra_time", $e_td);
                $this->RoasterDetail->saveField("attend_status", "complete");
            }
        }