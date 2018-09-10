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

        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14)));
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
        $this->set(compact('datas', 'data1', 'supervisor', 'agent', 'technician'));
    }

    function roaster_change() {
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('pull')) {
            $date_s = $this->request->data['StaticRoaster']['date']['year'] . '-' . $this->request->data['StaticRoaster']['date']['month'] . '-' . $this->request->data['StaticRoaster']['date']['day'];
            
            $date_p = date("Y-m-d");
              
           if ($date_s < $date_p) {
                $msg = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> You can not set this date roaster :-) </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
            $convert_date1 = strtotime($date_s);
            $name_day = date('l', $convert_date1);

            $sql = "select * from static_roasters where day_name ='$name_day'";
            $roaster = $this->StaticRoaster->query($sql);
            $id = $roaster[0]['static_roasters']['id'];
            if (!empty($id)) {
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
                $datas = $data[0];
                //pr($datas); exit;
                $clicked = true;
                $th = $this->StaticRoaster->query("SELECT * FROM static_roasters ");
                $data1 = $th[0]['static_roasters'];
                $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14)));
                $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
                $this->set(compact('date_s', 'datas', 'data1', 'supervisor', 'agent', 'technician'));
            }
        }
        $this->set(compact('clicked'));
    }

    function roaster_modify() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('pull')) {
            $date_s = $this->request->data['RoasterHistorie']['date']['year'] . '-' . $this->request->data['RoasterHistorie']['date']['month'] . '-' . $this->request->data['RoasterHistorie']['date']['day'];
            $date_p = date("Y-m-d");
              
           if ($date_s < $date_p) {
                $msg = '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> You can not modify this date roaster :-) </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
            
            $date_s = $this->request->data['RoasterHistorie']['date']['year'] . '-' . $this->request->data['RoasterHistorie']['date']['month'] . '-' . $this->request->data['RoasterHistorie']['date']['day'];
            $sql = "select * from roasters_histories where date ='$date_s'";
            $roaster = $this->RoasterHistorie->query($sql);
            if (!empty($roaster)) {
                $id = $roaster[0]['roasters_histories']['id'];
            }

            if (!empty($id)) {
                $data = $this->RoasterHistorie->query("SELECT * FROM roasters_histories            
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
                left join users nia10 on nia10.id = roasters_histories.nia10  where roasters_histories.id =$id ");
                $datas = $data[0];
                //pr($datas); exit;
                $clicked = true;
                $th = $this->StaticRoaster->query("SELECT * FROM static_roasters ");
                $data1 = $th[0]['static_roasters'];
                $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14)));
                $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
                $this->set(compact('date_s', 'datas', 'data1', 'supervisor', 'agent', 'technician'));
            }
        }
        $this->set(compact('clicked'));
    }

    //new roaster set for morning
    function modify_roastermorning() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];


        $date_s = $this->request->data['RoasterHistorie']['date'];
        $shift_name_time = $this->request->data['RoasterHistorie']['shift'];
        $alphabet = 'A';
        $convert_date1 = strtotime($date_s);
        $day_name = date('l', $convert_date1);
        //data delete from RoasterDetail
        $this->RoasterDetail->query("DELETE FROM roaster_details WHERE `date` = '$date_s' and shift_name_time = '$shift_name_time'");
        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");

        if (!empty($data_rh)) {
            $id = $data_rh[0]['roasters_histories']['id'];
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'id' => $id,
                'shift_name_time' => $this->request->data['RoasterHistorie']['shift'],
                'alphabet_a' => $alphabet,
                'shift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                'shift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                'shift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                'a1_id' => $this->request->data['RoasterHistorie']['a1_id'],
                'a2' => $this->request->data['RoasterHistorie']['a2'],
                'a3' => $this->request->data['RoasterHistorie']['a3'],
                'a4' => $this->request->data['RoasterHistorie']['a4'],
                'a5' => $this->request->data['RoasterHistorie']['a5'],
                'a6' => $this->request->data['RoasterHistorie']['a6'],
                'a7' => $this->request->data['RoasterHistorie']['a7'],
                'a8' => $this->request->data['RoasterHistorie']['a8'],
                'a9' => $this->request->data['RoasterHistorie']['a9'],
                'a10' => $this->request->data['RoasterHistorie']['a10']
            );
            $this->RoasterHistorie->save($data4rHistory);
        }

        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 5, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $shift_name_time;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    //new roaster set for afternoon
    function modify_roasterafternoon() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $date_s = $this->request->data['RoasterHistorie']['date'];
        $afshift_name_time2 = 'Afternoon (01:00 - 09:00)';
        $alphabet = 'B';
        //data delete from RoasterDetail
        $this->RoasterDetail->query("DELETE FROM roaster_details WHERE `date` = '$date_s' and shift_name_time = '$afshift_name_time2'");
        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");

        if (!empty($data_rh)) {
            $id = $data_rh[0]['roasters_histories']['id'];
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'id' => $id,
                'afshift_name_time2' => $afshift_name_time2,
                'alphabet_b' => $alphabet,
                'afshift_incharge_id' => $this->request->data['RoasterHistorie']['afshift_incharge_id'],
                'afshift_incharge2_id' => $this->request->data['RoasterHistorie']['afshift_incharge2_id'],
                'afshift_incharge3_id' => $this->request->data['RoasterHistorie']['afshift_incharge3_id'],
                'afa1_id' => $this->request->data['RoasterHistorie']['afa1_id'],
                'afa2' => $this->request->data['RoasterHistorie']['afa2'],
                'afa3' => $this->request->data['RoasterHistorie']['afa3'],
                'afa4' => $this->request->data['RoasterHistorie']['afa4'],
                'afa5' => $this->request->data['RoasterHistorie']['afa5'],
                'afa6' => $this->request->data['RoasterHistorie']['afa6'],
                'afa7' => $this->request->data['RoasterHistorie']['afa7'],
                'afa8' => $this->request->data['RoasterHistorie']['afa8'],
                'afa9' => $this->request->data['RoasterHistorie']['afa9'],
                'afa10' => $this->request->data['RoasterHistorie']['afa10']
            );
            $this->RoasterHistorie->save($data4rHistory);
        }

        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 5, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $afshift_name_time2;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    //new roaster set for afternoon
    function modify_roasternight() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $date_s = $this->request->data['RoasterHistorie']['date'];
        $nishift_name_time3 = 'Night (09:00 - 03:00)';
        $alphabet = 'C';
        //data delete from RoasterDetail
        $this->RoasterDetail->query("DELETE FROM roaster_details WHERE `date` = '$date_s' and shift_name_time = '$nishift_name_time3'");
        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");

        if (!empty($data_rh)) {
            $id = $data_rh[0]['roasters_histories']['id'];
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'id' => $id,
                'nishift_name_time3' => $nishift_name_time3,
                'alphabet_c' => $alphabet,
                'nishift_incharge_id' => $this->request->data['RoasterHistorie']['nishift_incharge_id'],
                'nishift_incharge2_id' => $this->request->data['RoasterHistorie']['nishift_incharge2_id'],
                'nishift_incharge3_id' => $this->request->data['RoasterHistorie']['nishift_incharge3_id'],
                'nia1_id' => $this->request->data['RoasterHistorie']['nia1_id'],
                'nia2' => $this->request->data['RoasterHistorie']['nia2'],
                'nia3' => $this->request->data['RoasterHistorie']['nia3'],
                'nia4' => $this->request->data['RoasterHistorie']['nia4'],
                'nia5' => $this->request->data['RoasterHistorie']['nia5'],
                'nia6' => $this->request->data['RoasterHistorie']['nia6'],
                'nia7' => $this->request->data['RoasterHistorie']['nia7'],
                'nia8' => $this->request->data['RoasterHistorie']['nia8'],
                'nia9' => $this->request->data['RoasterHistorie']['nia9'],
                'nia10' => $this->request->data['RoasterHistorie']['nia10']
            );
            $this->RoasterHistorie->save($data4rHistory);
        }

        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 5, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $nishift_name_time3;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function autosetroaster() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();

        //pc , ip and date time collect start
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        //pc , ip and date time collect end

        $list = array();
        $month = date('m');
        $year = date('y');
        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time) == $month)
//                $list[] = date('Y-m-d l', $time);
                $list[] = date('Y-m-d', $time);
        }
//        echo "<pre>";
//        print_r($list);
//        echo "</pre>";
//        for ($d = 1; $d <= 31; $d++) {
        foreach ($list as $aa) {

            $convert_date1 = strtotime($aa);
            $name_day = date('l', $convert_date1);
//                $sql = "SELECT `day_name`, `shift_name_time`, `shift_incharge_id`, `shift_incharge2_id`, `shift_incharge3_id`, `a1_id`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `afshift_name_time2`, `afshift_incharge_id`, `afshift_incharge2_id`, `afshift_incharge3_id`, `afa1_id`, `afa2`, `afa3`, `afa4`, `afa5`, `afa6`, `afa7`, `afa8`, `afa9`, `afa10`, `afa11`, `nishift_name_time3`, `nishift_incharge_id`, `nishift_incharge2_id`, `nishift_incharge3_id`, `nia1_id`, `nia2`, `nia3`, `nia4`, `nia5`, `nia6`, `nia7`, `nia8`, `nia9`, `nia10`, `nia11`, `date`, `status` FROM static_roasters WHERE day_name = '$name_day'";
//                $temp = $this->StaticRoaster->query($sql);

            $data = $this->StaticRoaster->query("SELECT `day_name`, `shift_name_time`, `shift_incharge_id`, `shift_incharge2_id`, 
                `shift_incharge3_id`, `a1_id`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`, `a10`, `a11`, `afshift_name_time2`,
                 `afshift_incharge_id`, `afshift_incharge2_id`, `afshift_incharge3_id`, `afa1_id`, `afa2`, `afa3`, `afa4`, `afa5`, `afa6`,
                  `afa7`, `afa8`, `afa9`, `afa10`, `afa11`, `nishift_name_time3`, `nishift_incharge_id`, `nishift_incharge2_id`, 
                  `nishift_incharge3_id`, `nia1_id`, `nia2`, `nia3`, `nia4`, `nia5`, `nia6`, `nia7`, `nia8`, `nia9`, `nia10`, `nia11`, 
                  `date`, `status` FROM static_roasters WHERE day_name = '$name_day'");
//                pr($data); exit;
//                $tt = $this->StaticRoaster->find('all', array('conditions' => array('StaticRoaster.day_name' => $name_day)));
            $dat = $this->RoasterHistorie->save($data[0]['static_roasters']);
        }
//        }
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Succeesfully set <?php echo $month ?> roaster </strong>
        </div>';
        $this->Session->setFlash($msg);
        // redirect page method & date wise            
        return $this->redirect($this->referer());
    }

    function daily() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $clicked = false;
        if (!empty($this->request->data)) {
            $date_s = $this->request->data['RoasterHistorie']['date']['year'] . '-' . $this->request->data['RoasterHistorie']['date']['month'] . '-' . $this->request->data['RoasterHistorie']['date']['day'];
            $shift = $this->request->data['RoasterHistorie']['shift'];
            $convert_date1 = strtotime($date_s);
            $name_day = date('l', $convert_date1);

            $sql = "select * from static_roasters where day_name ='$name_day'";
            $roaster = $this->StaticRoaster->query($sql);

            $id = $roaster[0]['static_roasters']['id'];
            $sql = "select * from static_roasters where id =$id";
            $roaster = $this->StaticRoaster->query($sql);

            $data_s = $roaster[0]['static_roasters'];
            //pr($data_s); exit;
            if ($shift == 'Morning (07:30 - 01:00)') {
                $data = $data_s;
                $array = array_values($data);
                $array2 = array_slice($array, 4, 16);
//                pr($array2); exit;
            } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                $array = array_values($data_s);
                $array2 = array_slice($array, 20, 16);
            } elseif ($shift == 'Night (09:00 - 03:00)') {
                $array = array_values($data_s);
                $array2 = array_slice($array, 36, 16);
            }

            //$trimmed_array = array_map('trim', $array2);
//            pr($trimmed_array); exit;
            $clicked = true;
            $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14, 'AND' => array('User.status' => 'active'))));
            $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7, 'AND' => array('User.status' => 'active'))));
            $this->set(compact('array2', 'agent', 'supervisor', 'date_s', 'name_day'));
        }
        $this->set(compact('clicked'));
    }

    function roasterview() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
//        Morning Afternoon Night
        $data = $this->RoasterHistorie->query("SELECT * FROM roasters_histories            

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
                left join users a11 on a11.id = roasters_histories.a11 

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
                left join users afa11 on afa11.id = roasters_histories.afa11
                

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
                 
                left join users nia10 on nia10.id = roasters_histories.nia10 
                left join users nia11 on nia11.id = roasters_histories.nia11
                ORDER BY roasters_histories.id ASC");

        $th = $this->StaticRoaster->query("SELECT * FROM static_roasters ");
        $data1 = $th[6]['static_roasters'];
        $datas = $data;
        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7)));
        $this->set(compact('datas', 'data1', 'supervisor', 'technician'));
    }

    function setnewroaster() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pr($this->request->data); exit;
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $date_s = $this->request->data['RoasterHistorie']['date'];
        $shift_name_time = $this->request->data['RoasterHistorie']['shift'];

        $alphabet = $this->request->data['RoasterHistorie']['alphabet'];
        $convert_date1 = strtotime($date_s);
        $day_name = date('l', $convert_date1);
        $data_e = $this->RoasterDetail->query("SELECT * FROM `roaster_details` WHERE `date` = '$date_s' and shift_name_time = '$shift_name_time'");
        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");
        if (!empty($data_e)) {
            $msg = 'Roaster has already been set for ' . $date_s . ', ' . $shift_name_time . ', ' . $day_name;
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        pr($shift_name_time);
        exit;
        if ($shift_name_time == 'Morning (07:30 - 01:00)') {
            pr('1');
            exit;
            if (!empty($data_rh)) {
                $id = $data_rh[0]['roasters_histories']['id'];
                $data4rHistory = array();
                $data4rHistory['RoasterHistorie'] = array(
                    'id' => $id,
                    'shift_name_time' => $this->request->data['RoasterHistorie']['shift'],
                    'alphabet' => $this->request->data['RoasterHistorie']['alphabet'],
                    'shift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                    'shift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                    'shift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                    'a1_id' => $this->request->data['RoasterHistorie']['a1'],
                    'a2' => $this->request->data['RoasterHistorie']['a2'],
                    'a3' => $this->request->data['RoasterHistorie']['a3'],
                    'a4' => $this->request->data['RoasterHistorie']['a4'],
                    'a5' => $this->request->data['RoasterHistorie']['a5'],
                    'a6' => $this->request->data['RoasterHistorie']['a6'],
                    'a7' => $this->request->data['RoasterHistorie']['a7'],
                    'a8' => $this->request->data['RoasterHistorie']['a8'],
                    'a9' => $this->request->data['RoasterHistorie']['a9'],
                    'a10' => $this->request->data['RoasterHistorie']['a10'],
                    'a11' => $this->request->data['RoasterHistorie']['a11'],
                );
                $this->RoasterHistorie->save($data4rHistory);
            } else {
                $data4rHistory = array();
                $data4rHistory['RoasterHistorie'] = array(
                    'date' => $this->request->data['RoasterHistorie']['date'],
                    'pc_id' => $pc_info,
                    'user_id' => $loggedUser['id'],
                    'day_name' => $day_name,
                    'shift_name_time' => $this->request->data['RoasterHistorie']['shift'],
                    'alphabet' => $this->request->data['RoasterHistorie']['alphabet'],
                    'shift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                    'shift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                    'shift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                    'a1_id' => $this->request->data['RoasterHistorie']['a1'],
                    'a2' => $this->request->data['RoasterHistorie']['a2'],
                    'a3' => $this->request->data['RoasterHistorie']['a3'],
                    'a4' => $this->request->data['RoasterHistorie']['a4'],
                    'a5' => $this->request->data['RoasterHistorie']['a5'],
                    'a6' => $this->request->data['RoasterHistorie']['a6'],
                    'a7' => $this->request->data['RoasterHistorie']['a7'],
                    'a8' => $this->request->data['RoasterHistorie']['a8'],
                    'a9' => $this->request->data['RoasterHistorie']['a9'],
                    'a10' => $this->request->data['RoasterHistorie']['a10'],
                    'a11' => $this->request->data['RoasterHistorie']['a11'],
                    'status' => 'yes'
                );
                $this->RoasterHistorie->save($data4rHistory);
            }
        } elseif ($shift_name_time == 'Afternoon (01:00 - 09:00)') {
            pr('2');
            exit;
            if (!empty($data_rh)) {
                $id = $data_rh[0]['roasters_histories']['id'];
                $data4rHistory = array();
                $data4rHistory['RoasterHistorie'] = array(
                    'id' => $id,
                    'afshift_name_time2' => $this->request->data['RoasterHistorie']['shift'],
                    'afshift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                    'afshift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                    'afshift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                    'afa1_id' => $this->request->data['RoasterHistorie']['a1'],
                    'afa2' => $this->request->data['RoasterHistorie']['a2'],
                    'afa3' => $this->request->data['RoasterHistorie']['a3'],
                    'afa4' => $this->request->data['RoasterHistorie']['a4'],
                    'afa5' => $this->request->data['RoasterHistorie']['a5'],
                    'afa6' => $this->request->data['RoasterHistorie']['a6'],
                    'afa7' => $this->request->data['RoasterHistorie']['a7'],
                    'afa8' => $this->request->data['RoasterHistorie']['a8'],
                    'afa9' => $this->request->data['RoasterHistorie']['a9'],
                    'afa10' => $this->request->data['RoasterHistorie']['a10'],
                    'afa11' => $this->request->data['RoasterHistorie']['a11'],
                    'status' => 'yes'
                );

                $this->RoasterHistorie->save($data4rHistory);
            } else {
                $data4rHistory = array();
                $data4rHistory['RoasterHistorie'] = array(
                    'date' => $this->request->data['RoasterHistorie']['date'],
                    'pc_id' => $pc_info,
                    'user_id' => $loggedUser['id'],
                    'day_name' => $day_name,
                    'afshift_name_time2' => $this->request->data['RoasterHistorie']['shift'],
                    'afshift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                    'afshift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                    'afshift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                    'afa1_id' => $this->request->data['RoasterHistorie']['a1'],
                    'afa2' => $this->request->data['RoasterHistorie']['a2'],
                    'afa3' => $this->request->data['RoasterHistorie']['a3'],
                    'afa4' => $this->request->data['RoasterHistorie']['a4'],
                    'afa5' => $this->request->data['RoasterHistorie']['a5'],
                    'afa6' => $this->request->data['RoasterHistorie']['a6'],
                    'afa7' => $this->request->data['RoasterHistorie']['a7'],
                    'afa8' => $this->request->data['RoasterHistorie']['a8'],
                    'afa9' => $this->request->data['RoasterHistorie']['a9'],
                    'afa10' => $this->request->data['RoasterHistorie']['a10'],
                    'afa11' => $this->request->data['RoasterHistorie']['a11'],
                    'status' => 'yes'
                );
                $this->RoasterHistorie->save($data4rHistory);
            }
        } elseif ($shift_name_time == 'Night (09:00 - 03:00)') {
            pr('3');
            exit;
            if (!empty($data_rh)) {
                $id = $data_rh[0]['roasters_histories']['id'];
                $data4rHistory = array();
                $data4rHistory['RoasterHistorie'] = array(
                    'id' => $id,
                    'nishift_name_time3' => $this->request->data['RoasterHistorie']['shift'],
                    'nishift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                    'nishift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                    'nishift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                    'nia1_id' => $this->request->data['RoasterHistorie']['a1'],
                    'nia2' => $this->request->data['RoasterHistorie']['a2'],
                    'nia3' => $this->request->data['RoasterHistorie']['a3'],
                    'nia4' => $this->request->data['RoasterHistorie']['a4'],
                    'nia5' => $this->request->data['RoasterHistorie']['a5'],
                    'nia6' => $this->request->data['RoasterHistorie']['a6'],
                    'nia7' => $this->request->data['RoasterHistorie']['a7'],
                    'nia8' => $this->request->data['RoasterHistorie']['a8'],
                    'nia9' => $this->request->data['RoasterHistorie']['a9'],
                    'nia10' => $this->request->data['RoasterHistorie']['a10'],
                    'nia11' => $this->request->data['RoasterHistorie']['a11'],
                    'status' => 'yes'
                );

                $this->RoasterHistorie->save($data4rHistory);
            } else {
                $data4rHistory = array();
                $data4rHistory['RoasterHistorie'] = array(
                    'date' => $this->request->data['RoasterHistorie']['date'],
                    'pc_id' => $pc_info,
                    'user_id' => $loggedUser['id'],
                    'day_name' => $day_name,
                    'nishift_name_time3' => $this->request->data['RoasterHistorie']['shift'],
                    'nishift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                    'nishift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                    'nishift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                    'nia1_id' => $this->request->data['RoasterHistorie']['a1'],
                    'nia2' => $this->request->data['RoasterHistorie']['a2'],
                    'nia3' => $this->request->data['RoasterHistorie']['a3'],
                    'nia4' => $this->request->data['RoasterHistorie']['a4'],
                    'nia5' => $this->request->data['RoasterHistorie']['a5'],
                    'nia6' => $this->request->data['RoasterHistorie']['a6'],
                    'nia7' => $this->request->data['RoasterHistorie']['a7'],
                    'nia8' => $this->request->data['RoasterHistorie']['a8'],
                    'nia9' => $this->request->data['RoasterHistorie']['a9'],
                    'nia10' => $this->request->data['RoasterHistorie']['a10'],
                    'nia11' => $this->request->data['RoasterHistorie']['a11'],
                    'status' => 'yes'
                );
                $this->RoasterHistorie->save($data4rHistory);
            }
        }
        pr('last');
        exit;
        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 3, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $shift_name_time;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end

            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
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

        //button hide when roaster setting complete
        $roaster_m = $this->RoasterHistorie->query("SELECT * FROM roasters_histories where date = '$d' AND shift_name_time != '' ");

        if (!empty($roaster_m)) {
            $roaster_date = $roaster_m[0]['roasters_histories']['date'];
        }
        //afternoon
        $roaster_a = $this->RoasterHistorie->query("SELECT * FROM roasters_histories where date = '$d' AND afshift_name_time2 != '' ");
        if (!empty($roaster_a)) {
            $roaster_date_a = $roaster_a[0]['roasters_histories']['date'];
        }
        //night
        $roaster_n = $this->RoasterHistorie->query("SELECT * FROM roasters_histories where date = '$d' AND afshift_name_time2 != '' ");
        if (!empty($roaster_n)) {
            $roaster_date_n = $roaster_n[0]['roasters_histories']['date'];
        }
        $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14, 'AND' => array('User.status' => 'active'))));
        $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7, 'AND' => array('User.status' => 'active'))));
        $this->set(compact('roaster_date', 'roaster_date_a', 'roaster_date_n', 'datas', 'data1', 'supervisor', 'agent', 'technician', 'date_s'));
    }

    function edit() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');

        $users = $this->User->find('list', array('order' => array('User.name' => 'ASC')));
        if ($this->request->is('post') || $this->request->is('put')) {
            $empid = $this->request->data['RoasterDetail']['emp_id'];
            $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details                 
        inner join users on users.id = roaster_details.user_id
        WHERE roaster_details.`user_id`= '$empid' AND attend_status = 'no' order by alphabet limit 0,49");
            pr($duty);
            exit;
            if (empty($duty)) {
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> This emp Id not found :-) </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $this->set(compact('users', 'duty'));
            }
        } else {
            $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details inner join users on users.id = roaster_details.user_id
                           WHERE attend_status = 'no' limit 0,21");
            $this->set(compact('users', 'duty'));
        }
    }

    function update() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $loggedUser = $this->Auth->user();
        $id = $this->request->data['RoasterDetail']['id'];
        $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
        $this->RoasterDetail->id = $id;
        $this->RoasterDetail->save($this->request->data['RoasterDetail']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster update succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
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

    //new roaster set for morning
    function setnewroastermorning() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $date_s = $this->request->data['RoasterHistorie']['date'];
        $shift_name_time = $this->request->data['RoasterHistorie']['shift'];
        $alphabet = 'A';
        $convert_date1 = strtotime($date_s);
        $day_name = date('l', $convert_date1);
        $data_e = $this->RoasterDetail->query("SELECT * FROM `roaster_details` WHERE `date` = '$date_s' and shift_name_time = '$shift_name_time'");
        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");
        if (!empty($data_e)) {
            $msg = 'Roaster has already been set for ' . $date_s . ', ' . $shift_name_time . ', ' . $day_name;
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        if (!empty($data_rh)) {
            $id = $data_rh[0]['roasters_histories']['id'];
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'id' => $id,
                'shift_name_time' => $this->request->data['RoasterHistorie']['shift'],
                'alphabet_a' => $alphabet,
                'shift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                'shift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                'shift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                'a1_id' => $this->request->data['RoasterHistorie']['a1'],
                'a2' => $this->request->data['RoasterHistorie']['a2'],
                'a3' => $this->request->data['RoasterHistorie']['a3'],
                'a4' => $this->request->data['RoasterHistorie']['a4'],
                'a5' => $this->request->data['RoasterHistorie']['a5'],
                'a6' => $this->request->data['RoasterHistorie']['a6'],
                'a7' => $this->request->data['RoasterHistorie']['a7'],
                'a8' => $this->request->data['RoasterHistorie']['a8'],
                'a9' => $this->request->data['RoasterHistorie']['a9'],
                'a10' => $this->request->data['RoasterHistorie']['a10'],
                'a11' => $this->request->data['RoasterHistorie']['a11'],
            );
            $this->RoasterHistorie->save($data4rHistory);
        } else {
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'date' => $this->request->data['RoasterHistorie']['date'],
                'pc_id' => $pc_info,
                'user_id' => $loggedUser['id'],
                'day_name' => $day_name,
                'shift_name_time' => $this->request->data['RoasterHistorie']['shift'],
                'alphabet_a' => $alphabet,
                'shift_incharge_id' => $this->request->data['RoasterHistorie']['shift_incharge_id'],
                'shift_incharge2_id' => $this->request->data['RoasterHistorie']['shift_incharge2_id'],
                'shift_incharge3_id' => $this->request->data['RoasterHistorie']['shift_incharge3_id'],
                'a1_id' => $this->request->data['RoasterHistorie']['a1_id'],
                'a2' => $this->request->data['RoasterHistorie']['a2'],
                'a3' => $this->request->data['RoasterHistorie']['a3'],
                'a4' => $this->request->data['RoasterHistorie']['a4'],
                'a5' => $this->request->data['RoasterHistorie']['a5'],
                'a6' => $this->request->data['RoasterHistorie']['a6'],
                'a7' => $this->request->data['RoasterHistorie']['a7'],
                'a8' => $this->request->data['RoasterHistorie']['a8'],
                'a9' => $this->request->data['RoasterHistorie']['a9'],
                'a10' => $this->request->data['RoasterHistorie']['a10'],
                'status' => 'yes'
            );
            $this->RoasterHistorie->save($data4rHistory);
        }

        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 5, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $shift_name_time;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
//            return $this->redirect('/roasters/roaster_change/' . $date_s);
        }
    }

    //new roaster set for afternoon
    function setnewroasterafternoon() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $date_s = $this->request->data['RoasterHistorie']['date'];
        $afshift_name_time2 = 'Afternoon (01:00 - 09:00)';
        $alphabet = 'B';
        $convert_date1 = strtotime($date_s);
        $day_name = date('l', $convert_date1);
        $data_e = $this->RoasterDetail->query("SELECT * FROM `roaster_details` WHERE `date` = '$date_s' and shift_name_time = '$afshift_name_time2'");

        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");
        if (!empty($data_e)) {
            $msg = 'Roaster has already been set for ' . $date_s . ', ' . $afshift_name_time2 . ', ' . $day_name;
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        if (!empty($data_rh)) {
            $id = $data_rh[0]['roasters_histories']['id'];
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'id' => $id,
                'afshift_name_time2' => $afshift_name_time2,
                'alphabet_b' => $alphabet,
                'afshift_incharge_id' => $this->request->data['RoasterHistorie']['afshift_incharge_id'],
                'afshift_incharge2_id' => $this->request->data['RoasterHistorie']['afshift_incharge2_id'],
                'afshift_incharge3_id' => $this->request->data['RoasterHistorie']['afshift_incharge3_id'],
                'afa1_id' => $this->request->data['RoasterHistorie']['afa1_id'],
                'afa2' => $this->request->data['RoasterHistorie']['afa2'],
                'afa3' => $this->request->data['RoasterHistorie']['afa3'],
                'afa4' => $this->request->data['RoasterHistorie']['afa4'],
                'afa5' => $this->request->data['RoasterHistorie']['afa5'],
                'afa6' => $this->request->data['RoasterHistorie']['afa6'],
                'afa7' => $this->request->data['RoasterHistorie']['afa7'],
                'afa8' => $this->request->data['RoasterHistorie']['afa8'],
                'afa9' => $this->request->data['RoasterHistorie']['afa9'],
                'afa10' => $this->request->data['RoasterHistorie']['afa10']
            );
            $this->RoasterHistorie->save($data4rHistory);
        } else {
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'date' => $this->request->data['RoasterHistorie']['date'],
                'pc_id' => $pc_info,
                'user_id' => $loggedUser['id'],
                'day_name' => $day_name,
                'afshift_name_time2' => $this->request->data['RoasterHistorie']['afshift_name_time2'],
                'alphabet_b' => $alphabet,
                'afshift_incharge_id' => $this->request->data['RoasterHistorie']['afshift_incharge_id'],
                'afshift_incharge2_id' => $this->request->data['RoasterHistorie']['afshift_incharge2_id'],
                'afshift_incharge3_id' => $this->request->data['RoasterHistorie']['afshift_incharge3_id'],
                'afa1_id' => $this->request->data['RoasterHistorie']['afa1_id'],
                'afa2' => $this->request->data['RoasterHistorie']['afa2'],
                'afa3' => $this->request->data['RoasterHistorie']['afa3'],
                'afa4' => $this->request->data['RoasterHistorie']['afa4'],
                'afa5' => $this->request->data['RoasterHistorie']['afa5'],
                'afa6' => $this->request->data['RoasterHistorie']['afa6'],
                'afa7' => $this->request->data['RoasterHistorie']['afa7'],
                'afa8' => $this->request->data['RoasterHistorie']['afa8'],
                'afa9' => $this->request->data['RoasterHistorie']['afa9'],
                'afa10' => $this->request->data['RoasterHistorie']['afa10'],
                'status' => 'yes'
            );
            $this->RoasterHistorie->save($data4rHistory);
        }
        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 5, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $afshift_name_time2;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
//             return $this->redirect('/roasters/roaster_change/' . $date_s);
        }
    }

    //new roaster set for afternoon
    function setnewroasternight() {
        $this->loadModel('User');
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $date_s = $this->request->data['RoasterHistorie']['date'];
        $nishift_name_time3 = 'Night (09:00 - 03:00)';
        $alphabet = 'C';
        $convert_date1 = strtotime($date_s);
        $day_name = date('l', $convert_date1);
        $data_e = $this->RoasterDetail->query("SELECT * FROM `roaster_details` WHERE `date` = '$date_s' and shift_name_time = '$nishift_name_time3'");

        $data_rh = $this->RoasterHistorie->query("SELECT * FROM `roasters_histories` WHERE `date` = '$date_s'");
        if (!empty($data_e)) {
            $msg = 'Roaster has already been set for ' . $date_s . ', ' . $nishift_name_time3 . ', ' . $day_name;
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        if (!empty($data_rh)) {
            $id = $data_rh[0]['roasters_histories']['id'];
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'id' => $id,
                'nishift_name_time3' => $nishift_name_time3,
                'alphabet_c' => $alphabet,
                'nishift_incharge_id' => $this->request->data['RoasterHistorie']['nishift_incharge_id'],
                'nishift_incharge2_id' => $this->request->data['RoasterHistorie']['nishift_incharge2_id'],
                'nishift_incharge3_id' => $this->request->data['RoasterHistorie']['nishift_incharge3_id'],
                'nia1_id' => $this->request->data['RoasterHistorie']['nia1_id'],
                'nia2' => $this->request->data['RoasterHistorie']['nia2'],
                'nia3' => $this->request->data['RoasterHistorie']['nia3'],
                'nia4' => $this->request->data['RoasterHistorie']['nia4'],
                'nia5' => $this->request->data['RoasterHistorie']['nia5'],
                'nia6' => $this->request->data['RoasterHistorie']['nia6'],
                'nia7' => $this->request->data['RoasterHistorie']['nia7'],
                'nia8' => $this->request->data['RoasterHistorie']['nia8'],
                'nia9' => $this->request->data['RoasterHistorie']['nia9'],
                'nia10' => $this->request->data['RoasterHistorie']['nia10']
            );
            $this->RoasterHistorie->save($data4rHistory);
        } else {
            $data4rHistory = array();
            $data4rHistory['RoasterHistorie'] = array(
                'date' => $this->request->data['RoasterHistorie']['date'],
                'pc_id' => $pc_info,
                'user_id' => $loggedUser['id'],
                'day_name' => $day_name,
                'sishift_name_time3' => $this->request->data['RoasterHistorie']['sishift_name_time3'],
                'alphabet_c' => $alphabet,
                'nishift_incharge_id' => $this->request->data['RoasterHistorie']['nishift_incharge_id'],
                'nishift_incharge2_id' => $this->request->data['RoasterHistorie']['nishift_incharge2_id'],
                'nishift_incharge3_id' => $this->request->data['RoasterHistorie']['nishift_incharge3_id'],
                'nia1_id' => $this->request->data['RoasterHistorie']['nia1_id'],
                'nia2' => $this->request->data['RoasterHistorie']['nia2'],
                'nia3' => $this->request->data['RoasterHistorie']['nia3'],
                'nia4' => $this->request->data['RoasterHistorie']['nia4'],
                'nia5' => $this->request->data['RoasterHistorie']['nia5'],
                'nia6' => $this->request->data['RoasterHistorie']['nia6'],
                'nia7' => $this->request->data['RoasterHistorie']['nia7'],
                'nia8' => $this->request->data['RoasterHistorie']['nia8'],
                'nia9' => $this->request->data['RoasterHistorie']['nia9'],
                'nia10' => $this->request->data['RoasterHistorie']['nia10'],
                'status' => 'yes'
            );
            $this->RoasterHistorie->save($data4rHistory);
        }
        if ($this->request->is('post') || $this->request->is('pull')) {
            $data = $this->request->data['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 5, 15);
            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
            //RoasterDetail insert start
            foreach ($array3 as $result) {
                $dd = $result;
                $this->request->data['RoasterDetail']['user_id'] = $dd;
                $this->request->data['RoasterDetail']['shift_name_time'] = $nishift_name_time3;
                $this->request->data['RoasterDetail']['alphabet'] = $alphabet;
                $this->request->data['RoasterDetail']['inserted_by'] = $loggedUser['id'];
                $this->request->data['RoasterDetail']['pc_id'] = $pc_info;
                $this->request->data['RoasterDetail']['date'] = $date_s;
                $this->RoasterDetail->create();
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }
            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Roaster save succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
//             return $this->redirect('/roasters/roaster_change' . $date_s);
        }
    }

    function script() {
        $this->loadModel('TempRs');
        $this->loadModel('RoasterHistorie');
        $now = new \DateTime('now');
        $date = date('t');

        // for each day in the month
        for ($i = 1; $i <= date('t'); $i++) {
            // add the date to the dates array
            $dates[] = date('Y') . "-" . date('m') . "-" . str_pad($i, 2, '0', STR_PAD_LEFT);
        }
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

    function updateroastermorning() { ///static morning roaster
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->StaticRoaster->set($this->request->data);

            $loggedUser = $this->Auth->user();
            $this->request->data['StaticRoaster']['user_id'] = $loggedUser['id'];
            //pr($this->request->data); exit;
            $this->StaticRoaster->id = $this->request->data['StaticRoaster']['id'];
            $this->StaticRoaster->save($this->request->data['StaticRoaster']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
//            return $this->redirect('/customers/edit/' . $this->request->data['PackageCustomer']['id']);setnewroastermorning
        }
    }

    function updateroasterafternoon() { ///static afternoon roaster
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->StaticRoaster->set($this->request->data);
            $loggedUser = $this->Auth->user();
            $this->request->data['StaticRoaster']['user_id'] = $loggedUser['id'];
            $this->StaticRoaster->id = $this->request->data['StaticRoaster']['id'];
            //pr($this->request->data); exit;
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

            $loggedUser = $this->Auth->user();
            $this->request->data['StaticRoaster']['user_id'] = $loggedUser['id'];
            $this->StaticRoaster->id = $this->request->data['StaticRoaster']['id'];
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


    function modify_roaster() {
        $this->loadModel('RoasterDetail');
        $this->loadModel('RoasterHistorie');
        $loggedUser = $this->Auth->user();

        $this->request->data['RoasterDetail']['user_id'] = $loggedUser['id'];
        $this->RoasterDetail->id = $this->request->data['RoasterDetail']['id'];
        $this->RoasterDetail->emp_id = $this->request->data['RoasterDetail']['emp_id'];
        $this->RoasterDetail->save($this->request->data);
        $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Roaster changed successfully:-) </strong>
			</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('/roasters/edit/' . $this->request->data['RoasterDetail']['emp_id']);
    }

    function roaster_update() {
        $this->loadModel('RoasterHistorie');
        $this->loadModel('StaticRoaster');
        $this->loadModel('User');
        $clicked = false;
        if (!empty($this->request->data)) {
            $date_s = $this->request->data['RoasterHistorie']['date']['year'] . '-' . $this->request->data['RoasterHistorie']['date']['month'] . '-' . $this->request->data['RoasterHistorie']['date']['day'];
            $shift = $this->request->data['RoasterHistorie']['shift'];
            $convert_date1 = strtotime($date_s);
            $name_day = date('l', $convert_date1);
            $sql = "select * from static_roasters where day_name ='$name_day'";
            $roaster = $this->StaticRoaster->query($sql);
            $data_s = $roaster[0]['static_roasters'];
            if ($shift == 'Morning (07:30 - 01:00)') {
                $data = $data_s;
                $array = array_values($data);
                $array2 = array_slice($array, 4, 16);
            } elseif ($shift == 'Afternoon (01:00 - 09:00)') {
                $array = array_values($data_s);

                $array2 = array_slice($array, 20, 16);
            } elseif ($shift == 'Night (09:00 - 03:00)') {
                $array = array_values($data_s);
                $array2 = array_slice($array, 36, 16);
            }
            $clicked = true;
            $agent = $this->User->find('list', array('conditions' => array('User.role_id' => 14, 'AND' => array('User.status' => 'active'))));
            $supervisor = $this->User->find('list', array('conditions' => array('User.role_id' => 7, 'AND' => array('User.status' => 'active'))));
            $this->set(compact('array2', 'agent', 'supervisor', 'date_s', 'name_day'));
        }
        $this->set(compact('clicked'));
    }

    function monthly_roaster() {
        $this->loadModel('RoasterDetail');
        $this->loadModel('User');
        $mon = date('F');
        $start = strtotime('first day of this month', time());
        $end = strtotime('last day of this month', time());
        $month_start = date('Y-m-d', $start);
        $month_end = date('Y-m-d', $end);
        $roaster_duty = $this->RoasterDetail->query("SELECT roaster_details.user_id,users.name,COUNT(roaster_details.user_id) as total_duty 
                FROM `roaster_details` LEFT JOIN users on users.id = roaster_details.user_id where roaster_details.date >= '$month_start'
                AND roaster_details.date <= '$month_end' AND roaster_details.date !='0000-00-00' GROUP BY roaster_details.user_id ");
        $this->set(compact('roaster_duty', 'mon'));
    }

    function emp_duty_detail() {
        $this->loadModel('User');
        //Time take in variable for validation end 
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Leave');

        // First day of this month
        $d = new DateTime('first day of this month');
        $d_f = $d->format('Y-m-d');

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $d_l = $date->format('Y-m-d');
        $id = $this->params['pass'][0];
        $conditions = " roaster_details.date >=' " . $d_f . "' AND  roaster_details.date <='" . $d_l . "'";
        $data = $this->RoasterDetail->query("SELECT * FROM `roaster_details` 
                left join users on users.id = roaster_details.user_id
                WHERE roaster_details.user_id = $id  AND $conditions order by roaster_details.date");
        $this->set(compact('data'));
    }

}

?>