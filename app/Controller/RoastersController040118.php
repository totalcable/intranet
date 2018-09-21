<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');

App::import('Controller', 'Reports');

class RoastersController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();

        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
//  echo 'here'; exit; //(array('action' => 'deshboard'));
        }

        $this->Auth->allow('');
    }

    function roaster_edit() {
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $id = $this->params['pass']['0'];
        $data = $this->StaticRoaster->query("SELECT * FROM static_roasters            

                left join users on users.id = static_roasters.shift_incharge_id 
                left join users u2 on u2.id = static_roasters.shift_incharge2_id 
                left join users u3 on u3.id = static_roasters.shift_incharge3_id 
                left join users a1 on a1.id = static_roasters.a1_id 
                left join users a2 on a2.id = static_roasters.a2 
                left join users a3 on a3.id = static_roasters.a3 
                left join users a4 on a4.id = static_roasters.a4 
                left join users a5 on a5.id = static_roasters.a5 
                left join users a6 on a6.id = static_roasters.a6  
                left join users a7 on a7.id = static_roasters.a7 
                left join users a8 on a8.id = static_roasters.a8 
                left join users a9 on a9.id = static_roasters.a9  
                left join users a10 on a10.id = static_roasters.a10 

                left join users af on af.id = static_roasters.afshift_incharge_id 
                left join users afu2 on afu2.id = static_roasters.afshift_incharge2_id 
                left join users afu3 on afu3.id = static_roasters.afshift_incharge3_id 
                left join users afa1 on afa1.id = static_roasters.afa1_id 
                left join users afa2 on afa2.id = static_roasters.afa2 
                left join users afa3 on afa3.id = static_roasters.afa3 
                left join users afa4 on afa4.id = static_roasters.afa4 
                left join users afa5 on afa5.id = static_roasters.afa5 
                left join users afa6 on afa6.id = static_roasters.afa6  
                left join users afa7 on afa7.id = static_roasters.afa7 
                left join users afa8 on afa8.id = static_roasters.afa8 
                left join users afa9 on afa9.id = static_roasters.afa9  
                left join users afa10 on afa10.id = static_roasters.afa10 
                

                left join users ni on ni.id = static_roasters.nishift_incharge_id 
                left join users niu2 on niu2.id = static_roasters.nishift_incharge2_id 
                left join users niu3 on niu3.id = static_roasters.nishift_incharge3_id 
                left join users nia1 on nia1.id = static_roasters.nia1_id 
                left join users nia2 on nia2.id = static_roasters.nia2 
                left join users nia3 on nia3.id = static_roasters.nia3 
                left join users nia4 on nia4.id = static_roasters.nia4 
                left join users nia5 on nia5.id = static_roasters.nia5 
                left join users nia6 on nia6.id = static_roasters.nia6  
                left join users nia7 on nia7.id = static_roasters.nia7 
                left join users nia8 on nia8.id = static_roasters.nia8 
                left join users nia9 on nia9.id = static_roasters.nia9  
                left join users nia10 on nia10.id = static_roasters.nia10  where static_roasters.id =$id ");

        $th = $this->StaticRoaster->query("SELECT * FROM static_roasters ");
        $data1 = $th[0]['static_roasters'];
        $datas = $data[0];
//        pr($datas['a4']['name']); exit;

        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14)));
//        pr($agent .' '.$supervisor); exit;
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
        $this->set(compact('datas', 'data1', 'supervisor', 'agent', 'technician'));
    }

    function setroaster() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $d = date("Y-m-d");
        $date_s = date("Y-m-d");

        $convert_date = strtotime($d);
        $name_day = date('l', $convert_date);
        if (!empty($this->request->data)) {
            $date_s = $this->request->data['RoasterHistorie']['date']['year'] . '-' . $this->request->data['RoasterHistorie']['date']['month'] . '-' . $this->request->data['RoasterHistorie']['date']['day'];
        }

        if (empty($this->request->data)) {
            if (!empty($this->params['pass']['0'])) {
                $date_s = $this->params['pass']['0'];
                $roaster_data = $this->RoasterHistorie->query("SELECT * FROM roasters_histories           
                left join users on users.id = roasters_histories.shift_incharge_id 
                left join users u2 on u2.id = roasters_histories.shift_incharge2_id 
                left join users u3 on u3.id = roasters_histories.shift_incharge3_id 
                left join users a1 on a1.id = roasters_histories.a1_id 
                left join users a2 on a2.id = roasters_histories.a2 
                left join users a3 on a3.id = roasters_histories.a3 
                left join users a4 on a4.id = roasters_histories.a4 
                left join users a5 on a5.id = roasters_histories.a5 
                left join users a6 on a6.id = roasters_histories.a6  
                left join users a7 on a7.id = roasters_histories.a7 
                left join users a8 on a8.id = roasters_histories.a8 
                left join users a9 on a9.id = roasters_histories.a9  
                left join users a10 on a10.id = roasters_histories.a10 

                left join users af on af.id = roasters_histories.afshift_incharge_id 
                left join users afu2 on afu2.id = roasters_histories.afshift_incharge2_id 
                left join users afu3 on afu3.id = roasters_histories.afshift_incharge3_id 
                left join users afa1 on afa1.id = roasters_histories.afa1_id 
                left join users afa2 on afa2.id = roasters_histories.afa2 
                left join users afa3 on afa3.id = roasters_histories.afa3 
                left join users afa4 on afa4.id = roasters_histories.afa4 
                left join users afa5 on afa5.id = roasters_histories.afa5 
                left join users afa6 on afa6.id = roasters_histories.afa6  
                left join users afa7 on afa7.id = roasters_histories.afa7 
                left join users afa8 on afa8.id = roasters_histories.afa8 
                left join users afa9 on afa9.id = roasters_histories.afa9  
                left join users afa10 on afa10.id = roasters_histories.afa10 
                
                left join users ni on ni.id = roasters_histories.nishift_incharge_id 
                left join users niu2 on niu2.id = roasters_histories.nishift_incharge2_id 
                left join users niu3 on niu3.id = roasters_histories.nishift_incharge3_id 
                left join users nia1 on nia1.id = roasters_histories.nia1_id 
                left join users nia2 on nia2.id = roasters_histories.nia2 
                left join users nia3 on nia3.id = roasters_histories.nia3 
                left join users nia4 on nia4.id = roasters_histories.nia4 
                left join users nia5 on nia5.id = roasters_histories.nia5 
                left join users nia6 on nia6.id = roasters_histories.nia6  
                left join users nia7 on nia7.id = roasters_histories.nia7 
                left join users nia8 on nia8.id = roasters_histories.nia8 
                left join users nia9 on nia9.id = roasters_histories.nia9  
                left join users nia10 on nia10.id = roasters_histories.nia10  where roasters_histories.date= '$date_s'");
                $datas = $roaster_data[0];
            }
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data)) {
                $date_s = $this->request->data['RoasterHistorie']['date']['year'] . '-' . $this->request->data['RoasterHistorie']['date']['month'] . '-' . $this->request->data['RoasterHistorie']['date']['day'];
            } else {

                $date_s = $d;
            }
        }

        if (!empty($roaster_data)) {
            $roaster_data = $this->RoasterHistorie->query("SELECT * FROM roasters_histories           
                left join users on users.id = roasters_histories.shift_incharge_id 
                left join users u2 on u2.id = roasters_histories.shift_incharge2_id 
                left join users u3 on u3.id = roasters_histories.shift_incharge3_id 
                left join users a1 on a1.id = roasters_histories.a1_id 
                left join users a2 on a2.id = roasters_histories.a2 
                left join users a3 on a3.id = roasters_histories.a3 
                left join users a4 on a4.id = roasters_histories.a4 
                left join users a5 on a5.id = roasters_histories.a5 
                left join users a6 on a6.id = roasters_histories.a6  
                left join users a7 on a7.id = roasters_histories.a7 
                left join users a8 on a8.id = roasters_histories.a8 
                left join users a9 on a9.id = roasters_histories.a9  
                left join users a10 on a10.id = roasters_histories.a10 

                left join users af on af.id = roasters_histories.afshift_incharge_id 
                left join users afu2 on afu2.id = roasters_histories.afshift_incharge2_id 
                left join users afu3 on afu3.id = roasters_histories.afshift_incharge3_id 
                left join users afa1 on afa1.id = roasters_histories.afa1_id 
                left join users afa2 on afa2.id = roasters_histories.afa2 
                left join users afa3 on afa3.id = roasters_histories.afa3 
                left join users afa4 on afa4.id = roasters_histories.afa4 
                left join users afa5 on afa5.id = roasters_histories.afa5 
                left join users afa6 on afa6.id = roasters_histories.afa6  
                left join users afa7 on afa7.id = roasters_histories.afa7 
                left join users afa8 on afa8.id = roasters_histories.afa8 
                left join users afa9 on afa9.id = roasters_histories.afa9  
                left join users afa10 on afa10.id = roasters_histories.afa10 
                
                left join users ni on ni.id = roasters_histories.nishift_incharge_id 
                left join users niu2 on niu2.id = roasters_histories.nishift_incharge2_id 
                left join users niu3 on niu3.id = roasters_histories.nishift_incharge3_id 
                left join users nia1 on nia1.id = roasters_histories.nia1_id 
                left join users nia2 on nia2.id = roasters_histories.nia2 
                left join users nia3 on nia3.id = roasters_histories.nia3 
                left join users nia4 on nia4.id = roasters_histories.nia4 
                left join users nia5 on nia5.id = roasters_histories.nia5 
                left join users nia6 on nia6.id = roasters_histories.nia6  
                left join users nia7 on nia7.id = roasters_histories.nia7 
                left join users nia8 on nia8.id = roasters_histories.nia8 
                left join users nia9 on nia9.id = roasters_histories.nia9  
                left join users nia10 on nia10.id = roasters_histories.nia10  where roasters_histories.date= '$date_s'");
            $datas = $roaster_data[0];
        } else {
            $convert_date1 = strtotime($date_s);
            $name_day = date('l', $convert_date1);
            $data = $this->StaticRoaster->query("SELECT * FROM static_roasters           
                left join users on users.id = static_roasters.shift_incharge_id 
                left join users u2 on u2.id = static_roasters.shift_incharge2_id 
                left join users u3 on u3.id = static_roasters.shift_incharge3_id 
                left join users a1 on a1.id = static_roasters.a1_id 
                left join users a2 on a2.id = static_roasters.a2 
                left join users a3 on a3.id = static_roasters.a3 
                left join users a4 on a4.id = static_roasters.a4 
                left join users a5 on a5.id = static_roasters.a5 
                left join users a6 on a6.id = static_roasters.a6  
                left join users a7 on a7.id = static_roasters.a7 
                left join users a8 on a8.id = static_roasters.a8 
                left join users a9 on a9.id = static_roasters.a9  
                left join users a10 on a10.id = static_roasters.a10 

                left join users af on af.id = static_roasters.afshift_incharge_id 
                left join users afu2 on afu2.id = static_roasters.afshift_incharge2_id 
                left join users afu3 on afu3.id = static_roasters.afshift_incharge3_id 
                left join users afa1 on afa1.id = static_roasters.afa1_id 
                left join users afa2 on afa2.id = static_roasters.afa2 
                left join users afa3 on afa3.id = static_roasters.afa3 
                left join users afa4 on afa4.id = static_roasters.afa4 
                left join users afa5 on afa5.id = static_roasters.afa5 
                left join users afa6 on afa6.id = static_roasters.afa6  
                left join users afa7 on afa7.id = static_roasters.afa7 
                left join users afa8 on afa8.id = static_roasters.afa8 
                left join users afa9 on afa9.id = static_roasters.afa9  
                left join users afa10 on afa10.id = static_roasters.afa10 
                
                left join users ni on ni.id = static_roasters.nishift_incharge_id 
                left join users niu2 on niu2.id = static_roasters.nishift_incharge2_id 
                left join users niu3 on niu3.id = static_roasters.nishift_incharge3_id 
                left join users nia1 on nia1.id = static_roasters.nia1_id 
                left join users nia2 on nia2.id = static_roasters.nia2 
                left join users nia3 on nia3.id = static_roasters.nia3 
                left join users nia4 on nia4.id = static_roasters.nia4 
                left join users nia5 on nia5.id = static_roasters.nia5 
                left join users nia6 on nia6.id = static_roasters.nia6  
                left join users nia7 on nia7.id = static_roasters.nia7 
                left join users nia8 on nia8.id = static_roasters.nia8 
                left join users nia9 on nia9.id = static_roasters.nia9  
                left join users nia10 on nia10.id = static_roasters.nia10  where static_roasters.day_name = '$name_day' ");
            $th = $this->StaticRoaster->query("SELECT * FROM static_roasters ");
            $data1 = $th[0]['static_roasters'];
            $datas = $data[0];
        }

        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14,'AND' => array('User.status'=> 'active'))));
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7,'AND' => array('User.status'=> 'active'))));
        $this->set(compact('datas', 'data1', 'supervisor', 'agent', 'technician', 'date_s'));
    }

    function setnewroastermorning_() { //new roaster morning
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $this->request->data['RoasterHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterHistorie']['pc_id'] = $pc_info;


        $date_4_search = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $data_roaster = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE roasters_histories.date = '$date_4_search'");


//            pr($data_roaster); exit;
        if (empty($data_roaster[0])) {
            unset($this->request->data['RoasterHistorie']['id']);
            $this->request->data['RoasterHistorie']['status'] = 'yes';
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
//            pr($this->request->data); exit;
            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            //RoasterDetail insert start
//            $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search'");

            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
//                  pr($array4); exit;
            foreach ($array4 as $result) {
                $id_history = array(
                    'emp_id' => $result
                );
//                    $date_ = $r_history['RoasterHistorie']['date'];
//                    $shift_name_time = $r_history['RoasterHistorie']['shift_name_time'];
//
//                    $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name_time' AND roaster_details.status = 'back data' limit 0,1");

                $this->request->data['RoasterDetail']['emp_id'] = $id_history['emp_id'][0];
//                    $this->request->data['RoasterDetail']['id'] = $roaster_detail[0]['roaster_details']['id'];
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Morning (20.00 - 02.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->request->data['RoasterDetail']['status'] = 'up data';
//                $this->request->data['RoasterDetail']['time'] = $m_history['MovieHistorie']['id'];
                $this->RoasterDetail->create();
                pr($this->request->data);
                exit;
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        } else {

//            if (!empty($this->request->data['RoasterHistorie']['id'])) {
            $this->request->data['RoasterHistorie']['id'] = $this->request->data['RoasterHistorie']['id'];
//            }
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));

            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            //RoasterDetail insert start
            $date_ = $r_history['RoasterHistorie']['date'];
            $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
            $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.shift_name_time = '$shift_name'");
            echo $this->RoasterDetail->getLastQuery();
            if (!empty($roaster_detail)) {
//                pr('there'); exit;
                foreach ($roaster_detail as $data_udate) {
                    $this->request->data['RoasterDetail']['id'] = $data_udate['roaster_details']['id'];
                    $this->request->data['RoasterDetail']['status'] = 'back data';
                    $this->RoasterDetail->save($this->request->data['RoasterDetail']);
                }

                $data = $r_history['RoasterHistorie'];
                $array = array_values($data);
                $array2 = array_slice($array, 4, 14);
                $array3 = array_filter($array2);
                $array4 = array_chunk($array3, 1);
//                  pr($array4); exit;
                foreach ($array4 as $result) {
                    $id_history = array(
                        'emp_id' => $result
                    );
                    $date_ = $r_history['RoasterHistorie']['date'];
                    $shift_name_time = $r_history['RoasterHistorie']['shift_name_time'];

                    $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name_time' AND roaster_details.status = 'back data' limit 0,1");

                    $this->request->data['RoasterDetail']['emp_id'] = $id_history['emp_id'][0];
                    $this->request->data['RoasterDetail']['id'] = $roaster_detail[0]['roaster_details']['id'];
                    $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                    $this->request->data['RoasterDetail']['shift_name_time'] = 'Morning (20.00 - 02.00)';
                    $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                    $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                    $this->request->data['RoasterDetail']['date'] = $data['date'];
                    $this->request->data['RoasterDetail']['status'] = 'up data';
//                $this->request->data['RoasterDetail']['time'] = $m_history['MovieHistorie']['id'];
                    $this->RoasterDetail->create();
                    $this->RoasterDetail->save($this->request->data['RoasterDetail']);
                }
            }
            //RoasterDetail end        

            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        }
    }

    function setnewroastermorning__() { //new roaster morning
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('TempRoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $this->request->data['RoasterHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterHistorie']['pc_id'] = $pc_info;

        $date_4_search = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $data_roaster = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE roasters_histories.date = '$date_4_search'");

        if (empty($data_roaster)) {
            unset($this->request->data['RoasterHistorie']['id']);
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));

            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            //RoasterDetail insert start
            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            foreach ($array4 as $result) {
                $id_history = array(
                    'emp_id' => $result
                );
                $this->request->data['RoasterDetail']['emp_id'] = $id_history['emp_id'][0];
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Morning (07.30 - 12.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['status'] = 1;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        } else {
            $this->request->data['RoasterHistorie']['id'] = $this->request->data['RoasterHistorie']['id'];
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
//            pr($r_history);
//            exit;
            //RoasterDetail insert start
            $date_ = $r_history['RoasterHistorie']['date'];
            $rh_id = $r_history['RoasterHistorie']['id'];
            $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
            $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.status = 1");
            foreach ($roaster_detail as $data_udate) {
                $this->request->data['RoasterDetail']['id'] = $data_udate['roaster_details']['id'];
                $this->request->data['RoasterDetail']['status'] = '0';
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name'");
//            pr($roaster_detail); exit;
            foreach ($roaster_detail as $result) {
//            
                $result['roaster_details']['status'] = '0';
//                pr($result['roaster_details']); exit;
                $this->TempRoasterDetail->save($result['roaster_details']);
            }
//               pr('here'); exit;
//            $this->TempRoasterDetail->query("DELETE FROM temproasterdetails");
//            $data = $r_history['RoasterHistorie'];
//            $roaster_id = $r_history['RoasterHistorie']['id'];
//            $multi = $this->RoasterDetail->query("SELECT * FROM `roasters_histories` LEFT JOIN roaster_details on roaster_details.roasters_histories_id =roasters_histories.id WHERE roaster_details.roasters_histories_id = $roaster_id");
//            foreach ($multi as $result) {
//                $roas_hi_data = $result['roasters_histories'];
//                $roas_de_data = $result['roaster_details'];
//                $array = array_values($roas_hi_data);
//                $array2 = array_slice($array, 5, 13);
//                $array3 = array_filter($array2);
//                $array4 = array_chunk($array3, 1);
//            }
//            pr($array4);
//            exit;
//            $array = array_values($data);
//            $array2 = array_slice($array, 4, 14);
//
//            $array3 = array_filter($array2);
//            $array4 = array_chunk($array3, 1);
            $multi1 = $this->TempRoasterDetail->query("SELECT * FROM `temproasterdetails` WHERE `status` != '1' ");
//            pr($multi1);
//            exit;
            foreach ($multi1 as $result11) {
//                pr($result11);
//                exit;
                $id_history = array(
                    'emp_id' => $result
                );

                $data_temp = array(
                    'id' => $result11['temproasterdetails']['id'],
                    'status' => '1'
                );

                $date_ = $r_history['RoasterHistorie']['date'];
                $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
                $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name' AND roaster_details.status = 0  limit 0,1");

                foreach ($roaster_detail as $res) {
                    $id = $res['roaster_details']['id'];
                    $this->request->data['RoasterDetail']['id'] = $id;
                    $this->request->data['RoasterDetail']['emp_id'] = $res['roaster_details']['emp_id'];
                    $this->request->data['RoasterDetail']['status'] = 1;
                    $this->request->data['RoasterDetail']['date'] = $date_;
                    $this->RoasterDetail->save($this->request->data['RoasterDetail']);
                    $this->TempRoasterDetail->save($data_temp);
                }
            }


            pr('there');
            exit;
//            foreach ($array4 as $result) {
//                $id_history = array(
//                    'emp_id' => $result
//                );
//                $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.status = 0 AND roaster_details.date = '$date_' limit 0,1");
////                echo $this->RoasterDetail->getLastQuery();
//
//
//                $this->request->data['TempRoasterDetail']['emp_id'] = $id_history['emp_id'][0];
//                $this->request->data['TempRoasterDetail']['roaster_detail_id'] = $roaster_detail[0]['roaster_details']['id'];
//                $this->request->data['TempRoasterDetail']['roasters_histories_id'] = $rh_id;
//                $this->request->data['TempRoasterDetail']['status'] = '0';
//                $this->request->data['TempRoasterDetail']['date'] = $date_;
//                $this->TempRoasterDetail->save($this->request->data['TempRoasterDetail']);
//            }
//            pr('done');
//            exit;
////            $length = count($array4);
////            $i = 0;
////           for ($i = 0; $i < count($array4); $i++){
//            foreach ($array4 as $result) {
//                pr($result); exit;
//                $id_history = array(
//                    'emp_id' => $result
//                );
//                $date_ = $r_history['RoasterHistorie']['date'];
//                $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
//                $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name' AND roaster_details.status = 0  limit 0,1");
//                foreach ($roaster_detail as $res) {
//                    $id = $res['roaster_details']['id'];
//                    $this->request->data['RoasterDetail']['id'] = $id;
//                    $this->request->data['RoasterDetail']['emp_id'] = $result[0];
//                    $this->request->data['RoasterDetail']['status'] = 1;
//                    $this->request->data['RoasterDetail']['date'] = $date_;
//                    $this->RoasterDetail->save($this->request->data['RoasterDetail']);
//                }
//            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        }
    }

    function r_detail_update($r_history, $id_history) {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $date_ = $r_history['RoasterHistorie']['date'];
        $shift_name_time = $r_history['RoasterHistorie']['shift_name_time'];
        $date_ = $r_history['RoasterHistorie']['date'];
        $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
        $data = $r_history['RoasterHistorie'];
        $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name_time' AND roaster_details.status = 0 limit 0,1");

        $id = $roaster_detail[0]['roaster_details']['id'];
//                pr($id); exit;
        $this->request->data['RoasterDetail']['id'] = $id;
        $this->request->data['RoasterDetail']['emp_id'] = $id_history['emp_id'][0];
        $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
        $this->request->data['RoasterDetail']['shift_name_time'] = 'Morning (20.00 - 02.00)';
        $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
        $this->request->data['RoasterDetail']['date'] = $data['date'];
        $this->request->data['RoasterDetail']['status'] = '1';
//        pr($this->request->data['RoasterDetail']);
//        exit;
        $this->RoasterDetail->save($this->request->data['RoasterDetail']);
    }

    function setnewroastermorning() { //new roaster morning
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $this->request->data['RoasterHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterHistorie']['pc_id'] = $pc_info;

        $date_4_search = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $data_roaster = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE roasters_histories.date = '$date_4_search'");
        if (empty($data_roaster)) {
            unset($this->request->data['RoasterHistorie']['id']);
            $this->request->data['RoasterHistorie']['status'] = 'yes';
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));

            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
            //RoasterDetail insert start
            $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.shift_name_time = '$shift_name'");

            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['emp_id'] = $dd;
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Morning (07.30 - 12.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        } else {
//            if (!empty($this->request->data['RoasterHistorie']['id'])) {
            $this->request->data['RoasterHistorie']['id'] = $this->request->data['RoasterHistorie']['id'];
//            }
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
            //RoasterDetail insert start
            $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.shift_name_time = '$shift_name'");
            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['emp_id'] = $dd;
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Morning (07.30 - 12.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        }
    }

    function setnewroasterafternoon() { //new roaster afternoon
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $this->request->data['RoasterHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterHistorie']['pc_id'] = $pc_info;

        $date_4_search = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $data_roaster = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE roasters_histories.date = '$date_4_search'");
        if (empty($data_roaster)) {
            unset($this->request->data['RoasterHistorie']['id']);
            $this->request->data['RoasterHistorie']['status'] = 'yes';
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));

            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            $shift_name = $r_history['RoasterHistorie']['afshift_name_time2'];
            //RoasterDetail insert start
            $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.shift_name_time = '$shift_name'");

            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['emp_id'] = $dd;
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Afternoon (12.00 - 20.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        } else {
            $this->request->data['RoasterHistorie']['id'] = $this->request->data['RoasterHistorie']['id'];
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);
            $shift_name = $r_history['RoasterHistorie']['afshift_name_time2'];
            //RoasterDetail insert start
            $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.shift_name_time = '$shift_name'");
            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['emp_id'] = $dd;
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Afternoon (12.00 - 20.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Afternoon roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        }
    }

    function setnewroasternight() { //new roaster morning
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $this->request->data['RoasterHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterHistorie']['pc_id'] = $pc_info;
        $date_4_search = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $data_roaster = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE roasters_histories.date = '$date_4_search'");

//        unset($this->request->data['RoasterHistorie']['id']);
        $this->request->data['RoasterHistorie']['status'] = 'yes';
        $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $this->RoasterHistorie->create();
        $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);

//RoasterDetail insert start
//        $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search'");

        $data = $r_history['RoasterHistorie'];
        $array = array_values($data);
        $array2 = array_slice($array, 4, 14);
        $array3 = array_filter($array2);
        $array4 = array_chunk($array3, 1);
        foreach ($array3 as $result) {
            $dd = $result;
            $this->request->data['RoasterDetail']['emp_id'] = $dd;
            $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
            $this->request->data['RoasterDetail']['shift_name_time'] = $data['nishift_name_time3'];
            $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
            $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
            $this->request->data['RoasterDetail']['date'] = $data['date'];
            $this->RoasterDetail->create();
            $this->RoasterDetail->save($this->request->data['RoasterDetail']);
        }
//RoasterDetail end

        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Night roaster save succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect('set_roaster' . DS . $date_4_search);
    }

    function roaster() {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        $roaster_list = $this->RoasterDetail->query("SELECT * FROM `roaster_details` LEFT JOIN users on roaster_details.emp_id = users.id");
        $this->set(compact('roaster_list'));
    }

    function roaster_date($date) {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        $roaster_list = $this->RoasterDetail->query("SELECT * FROM `roaster_details` LEFT JOIN users on roaster_details.emp_id = users.id where roaster_details.date = '$date' ");
        $this->set(compact('roaster_list'));
    }

    function roaster_id($emp_id) {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        $roaster_list = $this->RoasterDetail->query("SELECT * FROM `roaster_details` LEFT JOIN users on roaster_details.emp_id = users.id where roaster_details.emp_id = '$emp_id' ");
        $this->set(compact('roaster_list'));
    }

    function roaster_shift($shift_name_time) {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        $roaster_list = $this->RoasterDetail->query("SELECT * FROM `roaster_details` LEFT JOIN users on roaster_details.emp_id = users.id where roaster_details.shift_name_time = '$shift_name_time' ");
        $this->set(compact('roaster_list'));
    }

    function set_swap() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $this->loadModel('SwapHistorie');

        $d = date("Y-m-d");
        $convert_date = strtotime($d);
        $name_day = date('l', $convert_date);

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->request->data)) {
                $date_s = $this->request->data['SwapHistorie']['date']['year'] . '-' . $this->request->data['SwapHistorie']['date']['month'] . '-' . $this->request->data['SwapHistorie']['date']['day'];
            } else {
                $date_s = $d;
            }
            $roaster_data = $this->SwapHistorie->query("SELECT * FROM swap_histories WHERE swap_histories.date = '$date_s'");
        }
        if (empty($this->request->data)) {
            if (!empty($this->params['pass']['0'])) {
                $date_s = $this->params['pass']['0'];
                $roaster_data = $this->SwapHistorie->query("SELECT * FROM swap_histories           
                left join users swapin1by on swapin1by.id = swap_histories.swapin1_mo_by 
                left join users swapin1for on swapin1for.id = swap_histories.swapin1_mo_for 
                left join users swapin2by on swapin2by.id = swap_histories.swapin2_mo_by 
                left join users swapin2for on swapin2for.id = swap_histories.swapin2_mo_for
				
                left join users swapa1by on swapa1by.id = swap_histories.swapa1_mo_by 
                left join users swapa1for on swapa1for.id = swap_histories.swapa1_mo_for				
                left join users swapa2by on swapa2by.id = swap_histories.swapa2_mo_by 
                left join users swapa2for on swapa2for.id = swap_histories.swapa2_mo_for
                left join users swapa3by on swapa3by.id = swap_histories.swapa3_mo_by 
                left join users swapa3for on swapa3for.id = swap_histories.swapa3_mo_for
                left join users swapa4by on swapa4by.id = swap_histories.swapa4_mo_by 
                left join users swapa4for on swapa4for.id = swap_histories.swapa4_mo_for


                left join users swapin1_afby on swapin1_afby.id = swap_histories.swapin1_af_by 
                left join users swapin1_affor on swapin1_affor.id = swap_histories.swapin1_af_for
                left join users swapin2_afby on swapin2_afby.id = swap_histories.swapin2_af_by 
                left join users swapin2_affor on swapin2_affor.id = swap_histories.swapin2_af_for				

                left join users swapa1_afby on swapa1_afby.id = swap_histories.swapa1_af_by 
                left join users swapa1_affor on swapa1_affor.id = swap_histories.swapa1_af_for
                left join users swapa2_afby on swapa2_afby.id = swap_histories.swapa2_af_by 
                left join users swapa2_affor on swapa2_affor.id = swap_histories.swapa2_af_for
                left join users swapa3_afby on swapa3_afby.id = swap_histories.swapa3_af_by 
                left join users swapa3_affor on swapa3_affor.id = swap_histories.swapa3_af_for
                left join users swapa4_afby on swapa4_afby.id = swap_histories.swapa4_af_by 
                left join users swapa4_affor on swapa4_affor.id = swap_histories.swapa4_af_for
				
                
                left join users swapin1_niby on swapin1_niby.id = swap_histories.swapin1_ni_by 
                left join users swapin1_nifor on swapin1_nifor.id = swap_histories.swapin1_ni_for
                left join users swapin2_niby on swapin2_niby.id = swap_histories.swapin2_ni_by 
                left join users swapin2_nifor on swapin2_nifor.id = swap_histories.swapin2_ni_for

                left join users swapa1_niby on swapa1_niby.id = swap_histories.swapa1_ni_by 
                left join users swapa1_nifor on swapa1_nifor.id = swap_histories.swapa1_ni_for
                left join users swapa2_niby on swapa2_niby.id = swap_histories.swapa2_ni_by 
                left join users swapa2_nifor on swapa2_nifor.id = swap_histories.swapa2_ni_for
                left join users swapa3_niby on swapa3_niby.id = swap_histories.swapa3_ni_by 
                left join users swapa3_nifor on swapa3_nifor.id = swap_histories.swapa3_ni_for
                left join users swapa4_niby on swapa4_niby.id = swap_histories.swapa4_ni_by 
                left join users swapa4_nifor on swapa4_nifor.id = swap_histories.swapa4_ni_for
                where swap_histories.date= '$date_s'");
                $datas = $roaster_data[0];
            }
        }

        if (!empty($roaster_data)) {
//             pr($date_s); exit;
            $roaster_data = $this->SwapHistorie->query("SELECT * FROM swap_histories           
                left join users swapin1by on swapin1by.id = swap_histories.swapin1_mo_by 
                left join users swapin1for on swapin1for.id = swap_histories.swapin1_mo_for 
                left join users swapin2by on swapin2by.id = swap_histories.swapin2_mo_by 
                left join users swapin2for on swapin2for.id = swap_histories.swapin2_mo_for
				
                left join users swapa1by on swapa1by.id = swap_histories.swapa1_mo_by 
                left join users swapa1for on swapa1for.id = swap_histories.swapa1_mo_for				
                left join users swapa2by on swapa2by.id = swap_histories.swapa2_mo_by 
                left join users swapa2for on swapa2for.id = swap_histories.swapa2_mo_for
                left join users swapa3by on swapa3by.id = swap_histories.swapa3_mo_by 
                left join users swapa3for on swapa3for.id = swap_histories.swapa3_mo_for
                left join users swapa4by on swapa4by.id = swap_histories.swapa4_mo_by 
                left join users swapa4for on swapa4for.id = swap_histories.swapa4_mo_for


                left join users swapin1_afby on swapin1_afby.id = swap_histories.swapin1_af_by 
                left join users swapin1_affor on swapin1_affor.id = swap_histories.swapin1_af_for
                left join users swapin2_afby on swapin2_afby.id = swap_histories.swapin2_af_by 
                left join users swapin2_affor on swapin2_affor.id = swap_histories.swapin2_af_for				

                left join users swapa1_afby on swapa1_afby.id = swap_histories.swapa1_af_by 
                left join users swapa1_affor on swapa1_affor.id = swap_histories.swapa1_af_for
                left join users swapa2_afby on swapa2_afby.id = swap_histories.swapa2_af_by 
                left join users swapa2_affor on swapa2_affor.id = swap_histories.swapa2_af_for
                left join users swapa3_afby on swapa3_afby.id = swap_histories.swapa3_af_by 
                left join users swapa3_affor on swapa3_affor.id = swap_histories.swapa3_af_for
                left join users swapa4_afby on swapa4_afby.id = swap_histories.swapa4_af_by 
                left join users swapa4_affor on swapa4_affor.id = swap_histories.swapa4_af_for
				
                
                left join users swapin1_niby on swapin1_niby.id = swap_histories.swapin1_ni_by 
                left join users swapin1_nifor on swapin1_nifor.id = swap_histories.swapin1_ni_for
                left join users swapin2_niby on swapin2_niby.id = swap_histories.swapin2_ni_by 
                left join users swapin2_nifor on swapin2_nifor.id = swap_histories.swapin2_ni_for

                left join users swapa1_niby on swapa1_niby.id = swap_histories.swapa1_ni_by 
                left join users swapa1_nifor on swapa1_nifor.id = swap_histories.swapa1_ni_for
                left join users swapa2_niby on swapa2_niby.id = swap_histories.swapa2_ni_by 
                left join users swapa2_nifor on swapa2_nifor.id = swap_histories.swapa2_ni_for
                left join users swapa3_niby on swapa3_niby.id = swap_histories.swapa3_ni_by 
                left join users swapa3_nifor on swapa3_nifor.id = swap_histories.swapa3_ni_for
                left join users swapa4_niby on swapa4_niby.id = swap_histories.swapa4_ni_by 
                left join users swapa4_nifor on swapa4_nifor.id = swap_histories.swapa4_ni_for
                where swap_histories.date= '$date_s'");
//             pr($roaster_data); exit;
            $datas = $roaster_data[0];
        }
        if (!empty($datas)) {
            $datas = $datas['swap_histories'];
        }

        if (empty($date_s)) {
            $date_s = $d;
        }
        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14)));
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
        $this->set(compact('datas', 'data1', 'supervisor', 'agent', 'date_s'));
    }

    function setswapmorning() {
        $this->loadModel('SwapHistorie');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $date_4_search = date('Y-m-d', strtotime($this->request->data['SwapHistorie']['date']));
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SwapHistorie']['user_id'] = $loggedUser['id'];
            $this->request->data['SwapHistorie']['swapin_set_mo'] = $loggedUser['id'];
            $this->request->data['SwapHistorie']['pc_id'] = $pc_info;
            $this->request->data['SwapHistorie']['shift_name'] = 'Morning shift';
            $date_4_search = date('Y-m-d', strtotime($this->request->data['SwapHistorie']['date']));
            $this->SwapHistorie->set($this->request->data['SwapHistorie']);
            if (!empty($this->request->data['SwapHistorie']['id'])) {
                $this->request->data['SwapHistorie']['id'] = $this->request->data['SwapHistorie']['id'];
                $this->SwapHistorie->save($this->request->data['SwapHistorie']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning shift swap update succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect('set_swap' . DS . $date_4_search);
            }
            $this->SwapHistorie->create();
            $this->SwapHistorie->save($this->request->data['SwapHistorie']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning shift swap save succeesfully </strong>
        </div>';
        }
        $this->Session->setFlash($msg);
        return $this->redirect('set_swap' . DS . $date_4_search);
    }

    function setswapafternoon() {
        $this->loadModel('SwapHistorie');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $date_4_search = date('Y-m-d', strtotime($this->request->data['SwapHistorie']['date']));
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SwapHistorie']['user_id'] = $loggedUser['id'];
            $this->request->data['SwapHistorie']['swapin_set_af'] = $loggedUser['id'];
            $this->request->data['SwapHistorie']['pc_id'] = $pc_info;
            $this->request->data['SwapHistorie']['shift_name'] = 'Afternoon shift';
            $date_4_search = date('Y-m-d', strtotime($this->request->data['SwapHistorie']['date']));
            $this->SwapHistorie->set($this->request->data['SwapHistorie']);
            if (!empty($this->request->data['SwapHistorie']['id'])) {
                $this->request->data['SwapHistorie']['id'] = $this->request->data['SwapHistorie']['id'];
                $this->SwapHistorie->save($this->request->data['SwapHistorie']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Afternoon shift swap update succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect('set_swap' . DS . $date_4_search);
            }
            $this->SwapHistorie->create();
            $this->SwapHistorie->save($this->request->data['SwapHistorie']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Afternoon shift swap save succeesfully </strong>
        </div>';
        }
        $this->Session->setFlash($msg);
        return $this->redirect('set_swap' . DS . $date_4_search);
    }

    function setswapnight() {
        $this->loadModel('SwapHistorie');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $date_4_search = date('Y-m-d', strtotime($this->request->data['SwapHistorie']['date']));
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['SwapHistorie']['user_id'] = $loggedUser['id'];
            $this->request->data['SwapHistorie']['swapin_set_ni'] = $loggedUser['id'];
            $this->request->data['SwapHistorie']['pc_id'] = $pc_info;
            $this->request->data['SwapHistorie']['shift_name'] = 'Night shift';
            $date_4_search = date('Y-m-d', strtotime($this->request->data['SwapHistorie']['date']));
            $this->SwapHistorie->set($this->request->data['SwapHistorie']);
            if (!empty($this->request->data['SwapHistorie']['id'])) {
                $this->request->data['SwapHistorie']['id'] = $this->request->data['SwapHistorie']['id'];
                $this->SwapHistorie->save($this->request->data['SwapHistorie']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Night shift swap update succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect('set_swap' . DS . $date_4_search);
            }
            $this->SwapHistorie->create();
            $this->SwapHistorie->save($this->request->data['SwapHistorie']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Night shift swap save succeesfully </strong>
        </div>';
        }
        $this->Session->setFlash($msg);
        return $this->redirect('set_swap' . DS . $date_4_search);
    }

    function setnewroasternight_back() { //new roaster night
        $this->loadModel('RoasterHistorie');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
//pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $this->request->data['RoasterHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['RoasterHistorie']['pc_id'] = $pc_info;
        $date_4_search = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
        $data_roaster = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE roasters_histories.date = '$date_4_search'");

        if (empty($data_roaster)) {
            unset($this->request->data['RoasterHistorie']['id']);
            $this->request->data['RoasterHistorie']['status'] = 'yes';
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
//            pr($this->request->data); exit;
            $this->RoasterHistorie->create();
            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);

//RoasterDetail insert start
            $this->RoasterDetail->query("DELETE FROM roaster_details WHERE roaster_details.date = '$date_4_search'");

            $data = $r_history['RoasterHistorie'];

            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['emp_id'] = $dd;
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = $data['nishift_name_time3'];
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
//                $this->request->data['RoasterDetail']['time'] = $m_history['MovieHistorie']['id'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end

            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Night roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        } else {
            if (!empty($this->request->data['RoasterHistorie']['id'])) {
                $this->request->data['RoasterHistorie']['id'] = $this->request->data['RoasterHistorie']['id'];
            }
            $this->request->data['RoasterHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['RoasterHistorie']['date']));
            $r_history = $this->RoasterHistorie->save($this->request->data['RoasterHistorie']);


            $date_ = $r_history['RoasterHistorie']['date'];
            $nishift_name_time3 = $r_history['RoasterHistorie']['nishift_name_time3'];

            $shift_name = $r_history['RoasterHistorie']['nishift_name_time3'];
            $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.shift_name_time = '$shift_name'");


            foreach ($roaster_detail as $data_udate) {
//                pr($data_udate); exit;
                $this->request->data['RoasterDetail']['id'] = $data_udate['roaster_details']['id'];
                $this->request->data['RoasterDetail']['status'] = 'back data';
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }

//            exit;
            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);

            foreach ($array4 as $result) {
                $id_history = array(
                    'emp_id' => $result['0']
                );
//            pr($id_history); exit;


                $date_ = $r_history['RoasterHistorie']['date'];
                $nishift_name_time3 = $r_history['RoasterHistorie']['nishift_name_time3'];

                $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$nishift_name_time3' AND roaster_details.status = 'back data' limit 0,1");

//                echo $this->RoasterDetail->getLastQuery();
//                pr($roaster_detail[0]['roaster_details']);
//                exit;
//                $dd = $result;
                $this->request->data['RoasterDetail']['id'] = $roaster_detail['0']['roaster_details']['id'];
                $this->request->data['RoasterDetail']['emp_id'] = $id_history['emp_id'];
                $this->request->data['RoasterDetail']['roasters_histories_id'] = $data['id'];
                $this->request->data['RoasterDetail']['shift_name_time'] = 'Night (20.00-02.00)';
                $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $data['date'];
                $this->request->data['RoasterDetail']['status'] = 'up data';
//                $this->request->data['RoasterDetail']['time'] = $m_history['MovieHistorie']['id'];
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
//RoasterDetail end

            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Night roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        }
    }

    function updateroastermorning() { ///static morning roaster
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->StaticRoaster->set($this->request->data);
            $this->StaticRoaster->id = $this->request->data['StaticRoaster']['id'];
            $loggedUser = $this->Auth->user();
            $this->request->data['StaticRoaster']['user_id'] = $loggedUser['id'];
            $this->StaticRoaster->save($this->request->data['StaticRoaster']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function updateroasterafternoon() { ///static afternoon roaster
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->StaticRoaster->set($this->request->data);
            $this->StaticRoaster->id = $this->request->data['StaticRoaster']['id'];
            $loggedUser = $this->Auth->user();
            $this->request->data['StaticRoaster']['user_id'] = $loggedUser['id'];
//            pr($this->request->data['StaticRoaster']); exit;
            $this->StaticRoaster->save($this->request->data['StaticRoaster']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Afternoon roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function updateroasternight() { ///static night roaster
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->StaticRoaster->set($this->request->data);
            $this->StaticRoaster->id = $this->request->data['StaticRoaster']['id'];
            $loggedUser = $this->Auth->user();
            $this->request->data['StaticRoaster']['user_id'] = $loggedUser['id'];
//            pr($this->request->data['StaticRoaster']); exit;
            $this->StaticRoaster->save($this->request->data['StaticRoaster']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Night roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function staticroaster() {
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
//        Morning Afternoon Night
        $data = $this->StaticRoaster->query("SELECT * FROM static_roasters            

                left join users on users.id = static_roasters.shift_incharge_id 
                left join users u2 on u2.id = static_roasters.shift_incharge2_id 
                left join users u3 on u3.id = static_roasters.shift_incharge3_id 
                left join users a1 on a1.id = static_roasters.a1_id 
                left join users a2 on a2.id = static_roasters.a2 
                left join users a3 on a3.id = static_roasters.a3 
                left join users a4 on a4.id = static_roasters.a4 
                left join users a5 on a5.id = static_roasters.a5 
                left join users a6 on a6.id = static_roasters.a6  
                left join users a7 on a7.id = static_roasters.a7 
                left join users a8 on a8.id = static_roasters.a8 
                left join users a9 on a9.id = static_roasters.a9  
                left join users a10 on a10.id = static_roasters.a10 
                left join users a11 on a11.id = static_roasters.a11 

                left join users af on af.id = static_roasters.afshift_incharge_id 
                left join users afu2 on afu2.id = static_roasters.afshift_incharge2_id 
                left join users afu3 on afu3.id = static_roasters.afshift_incharge3_id 
                left join users afa1 on afa1.id = static_roasters.afa1_id 
                left join users afa2 on afa2.id = static_roasters.afa2 
                left join users afa3 on afa3.id = static_roasters.afa3 
                left join users afa4 on afa4.id = static_roasters.afa4 
                left join users afa5 on afa5.id = static_roasters.afa5 
                left join users afa6 on afa6.id = static_roasters.afa6  
                left join users afa7 on afa7.id = static_roasters.afa7 
                left join users afa8 on afa8.id = static_roasters.afa8 
                left join users afa9 on afa9.id = static_roasters.afa9  
                left join users afa10 on afa10.id = static_roasters.afa10 
                left join users afa11 on afa11.id = static_roasters.afa11
                

                left join users ni on ni.id = static_roasters.nishift_incharge_id 
                left join users niu2 on niu2.id = static_roasters.nishift_incharge2_id 
                left join users niu3 on niu3.id = static_roasters.nishift_incharge3_id 
                left join users nia1 on nia1.id = static_roasters.nia1_id 
                left join users nia2 on nia2.id = static_roasters.nia2 
                left join users nia3 on nia3.id = static_roasters.nia3 
                left join users nia4 on nia4.id = static_roasters.nia4 
                left join users nia5 on nia5.id = static_roasters.nia5 
                left join users nia6 on nia6.id = static_roasters.nia6  
                left join users nia7 on nia7.id = static_roasters.nia7 
                left join users nia8 on nia8.id = static_roasters.nia8 
                left join users nia9 on nia9.id = static_roasters.nia9
                 
                left join users nia10 on nia10.id = static_roasters.nia10 
                left join users nia11 on nia11.id = static_roasters.nia11
                ORDER BY static_roasters.id ASC");

        $th = $this->StaticRoaster->query("SELECT * FROM static_roasters ");
//        pr($th); exit;
        $data1 = $th[6]['static_roasters'];
//        pr($data1); exit;
        $datas = $data;
        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
//        pr($agent .' '.$supervisor); exit;
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
        $this->set(compact('datas', 'data1', 'supervisor', 'technician'));
    }

//pr('hello am I here :-)'); exit;
}

?>