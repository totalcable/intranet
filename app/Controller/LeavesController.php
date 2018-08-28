<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');

App::import('Controller', 'Reports');

class LeavesController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();

        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
//  echo 'here'; exit; //(array('action' => 'deshboard'));
        }

        $this->Auth->allow('');
    }

    function add() {
        $this->loadModel('Leave');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Emp');
        $datej = date("Y-m-d");

        $loggedUser = $this->Auth->user();
        $u_id = $loggedUser['id'];
        $name = $loggedUser['name'];
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['Leave']['daterange'], true);
            $ds = $datrange['start'];
            $de = $datrange['end'];
            //$this->Leave->set($this->request->data);
            $this->request->data['Leave']['emp_id'] = $loggedUser['id'];
            $this->request->data['Leave']['pc_id'] = $pc_info;
            $this->request->data['Leave']['from_date'] = $ds;
            $this->request->data['Leave']['to_date'] = $de;
            $this->request->data['Leave']['date'] = date("Y-m-d");
            $this->request->data['Leave']['status'] = 'requested';

            $this->Leave->save($this->request->data['Leave']);
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Record succeesfully inserted</strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('add');
        }
        //update emp table remaining leave
        $e = $this->Emp->query("SELECT * FROM `emps` WHERE `user_id` = $u_id");
        $r_l = $e[0]['emps']['r_leave'];

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $l_d = $date->format('Y-m-d');
        $duty = $this->RoasterDetail->query("SELECT * FROM roaster_details WHERE `date` <= '$l_d' AND emp_id = $u_id  AND attend_status != 'approve' order by alphabet");
        $this->set(compact('r_l', 'name', 'duty', 'cities'));
    }

    function manage() {
        $this->loadModel('Emp');
        $this->loadModel('User');
        $this->loadModel('Designation');
        $this->loadModel('Leave');
        $leave = $this->Leave->query("SELECT * FROM leaves  left join emps on emps.id = leaves.emp_id left join users on users.id = emps.user_id left join designations on designations.id = emps.designation_id left join departments on departments.id = emps.department_id where leaves.status != 'admin_approved'");
        $this->set(compact('leave'));
    }

    function leave_approve_si() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Leave');
        $this->loadModel('User');
        $leave = $this->Leave->query("SELECT * FROM `leaves` 
                inner join emps on emps.id = leaves.emp_id
                 left join users on users.id = emps.user_id
                WHERE leaves.`status` = 'requested' order by date");
        $this->set(compact('leave'));
    }

    function leave_approve_admin() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Leave');
        $this->loadModel('User');
        $leave = $this->Leave->query("SELECT * FROM `leaves` 
                inner join emps on emps.id = leaves.emp_id
                left join users on users.id = emps.user_id
                WHERE leaves.`status` = 'si_approved' order by date");
        $this->set(compact('leave'));
    }

    function approvebysi() {
        $this->loadModel('Leave');
        $loggedUser = $this->Auth->user();
        $u_id = $loggedUser['id'];
        $l_d = date("Y-m-d");
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $data4l = array();
        $data4l['Leave'] = array(
            'id' => $this->request->data['Leave']['id'],
            'si_comment' => $this->request->data['Leave']['comment'],
            'status' => 'si_approved',
            'si_approve_date' => $l_d,
            'si_id' => $u_id,
            'pc_id' => $pc_info
        );
        // pr($data4l); exit;
        $this->Leave->save($data4l);
        $msg = '<div class="alert alert-successful">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> Record has been approved</strong>
                </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function leaveofroaster() {
        $this->loadModel('Leave');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Emp');
        $start = $this->params['pass'][0];
        $end = $this->params['pass'][1];
        $u_id = $this->params['pass'][2];

        $conditions = " roaster_details.date >=' " . $start . "' AND  roaster_details.date <='" . $end . "'";
        $data_e = $this->RoasterDetail->query("SELECT * FROM `roaster_details` left join users on users.id = roaster_details.emp_id WHERE `emp_id` = $u_id and $conditions order by date");
        $this->set(compact('data_e'));
    }

    function approvebyadmin() {
        $this->loadModel('Leave');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Emp');
        $loggedUser = $this->Auth->user();
        $u_id = $loggedUser['id'];
        $l_d = date("Y-m-d");
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        $user_id = $this->request->data['Leave']['user_id'];
        $start = $this->request->data['Leave']['from_date'];
        $end = $this->request->data['Leave']['to_date'];

        if ($start == $end) {
            $conditions = "roaster_details.date >=' " . $start . "' AND  roaster_details.date <= '" . $end . " '";
        } else {
            $conditions = " roaster_details.date >=' " . $start . "' AND  roaster_details.date <='" . $end . "'";
        }
        $data_e = $this->RoasterDetail->query("SELECT * FROM `roaster_details` WHERE `emp_id` = $user_id and $conditions");

        //update emp table remaining leave
        $e = $this->Emp->query("SELECT * FROM `emps` WHERE `user_id` = $user_id");
        $id_e = $e[0]['emps']['id'];
        //$s = $e[0]['emps']['sick'];
        // $c = $e[0]['emps']['casual'];
        $r_leave = $e[0]['emps']['r_leave'];

        $y = count($data_e);

//        $r_leaves = (($s + $c) - ($y + $old_leave));
        $r_leaves = ($r_leave - $y);
        //pr($r_leaves); exit;
//        $minus = substr($r_leaves,0,1);
//        if($minus == '-'){
//            
//            $msg = '<div class="alert alert-success">
//				<button type="button" class="close" data-dismiss="alert">&times;</button>
//				<strong> Contact with HR about your "Leave"</strong>
//			</div>';
//            $this->Session->setFlash($msg);
//            return $this->redirect($this->referer());
//        }
        //pr('complete'); exit;
        // Update roasterDetail table for leave
        $this->Emp->id = $id_e;
        $this->Emp->saveField("r_leave", $r_leaves);

        for ($x = 0; $x < $y; $x++) {
            foreach ($data_e as $value) {
                $id = $value['roaster_details']['id'];
                $al = $value['roaster_details']['alphabet'];
                if ($al == 'A') {
                    $t = '05:30';
                } elseif ($al == 'B') {
                    $t = '08:00';
                } elseif ($al == 'C') {
                    $t = '06:00';
                }
                // Update roasterDetail table for leave
                $roasterdetail = array(
                    'id' => $id,
                    'attend_status' => 'leave',
                    'total_duty' => $t
                );
                $this->RoasterDetail->save($roasterdetail);
            }
        }
        $data4l = array();
        $data4l['Leave'] = array(
            'id' => $this->request->data['Leave']['id'],
            'admin_comment' => $this->request->data['Leave']['comment'],
            'status' => 'admin_approved',
            'total' => $y,
            'admin_approve_date' => $l_d,
            'admin_id' => $u_id,
            'pc_id' => $pc_info
        );
        $this->Leave->save($data4l);
        $msg = '<div class="alert alert-successful">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> Record has been approved</strong>
                </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function leave_approve() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Leave');
        $this->loadModel('User');
        $leaves = $this->Leave->query("SELECT * FROM leaves left join emps on emps.id = leaves.emp_id left join users on users.id = emps.user_id left join designations on designations.id = emps.designation_id left join departments on departments.id = emps.department_id where leaves.status = 'admin_approved'");
        $this->set(compact('leaves'));
    }

    function emp_leave() {
        $this->loadModel('User');
        //Time take in variable for validation end 
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Leave');
        //$date = new DateTime('now');
        // $d = new DateTime('first day of this month');
        // First day of this month
        $d = new DateTime('first day of this month');
        $d_f = $d->format('Y-m-d');

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $d_l = $date->format('Y-m-d');


        $conditions = " roaster_details.date >=' " . $d_f . "' AND  roaster_details.date <='" . $d_l . "'";


        $absent = $this->RoasterDetail->query("SELECT count(attend_status)as total_absent FROM `roaster_details` WHERE roaster_details.`attend_status` = 'absent' and $conditions");
        $total_absent = $absent[0][0]['total_absent'];
        $late = $this->RoasterDetail->query("SELECT count(late_time)as total_late FROM `roaster_details` WHERE roaster_details.`late_time` != '00:00:00' and $conditions");
        $total_late = $late[0][0]['total_late'];
        //echo $this->RoasterDetail->getLastQuery();
//        pr($total_absent.' '.$total_late);
//        exit;
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Emp->id = $this->request->data['Emp']['id'];
            $r = ($this->request->data['Emp']['sick'] + $this->request->data['Emp']['casual']);
            $this->Emp->saveField("sick", $this->request->data['Emp']['sick']);
            $this->Emp->saveField("casual", $this->request->data['Emp']['casual']);
            $this->Emp->saveField("earn_leave", $this->request->data['Emp']['earn_leave']);
            $this->Emp->saveField("r_leave", $r);
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Leave information updated successfully:-) </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('emp_leave');
        }
        $emps = $this->Emp->query("SELECT * FROM emps
                left join users on users.id = emps.user_id 
                left join designations on designations.id = emps.designation_id 
                left join departments on departments.id = emps.department_id 
                where users.status = 'active'");
        $this->set(compact('emps', 'total_late', 'total_absent'));
    }

    function emp_late() {
        $this->loadModel('User');
        //Time take in variable for validation end 
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Leave');
        //$date = new DateTime('now');
        // $d = new DateTime('first day of this month');
        // First day of this month
        $d = new DateTime('first day of this month');
        $d_f = $d->format('Y-m-d');

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $d_l = $date->format('Y-m-d');

        $conditions = " roaster_details.date >=' " . $d_f . "' AND  roaster_details.date <='" . $d_l . "'";

//        $absent = $this->RoasterDetail->query("SELECT count(attend_status)as total_absent FROM `roaster_details` WHERE roaster_details.`attend_status` = 'absent' and $conditions");
//         $total_absent = $absent[0][0]['total_absent'];
        $late = $this->RoasterDetail->query("SELECT emp_id,roaster_details.date,roaster_details.id,users.name,count(roaster_details.late_time)as total_late                
                FROM `roaster_details` 
                left join users on users.id = roaster_details.emp_id 
                left join emps on emps.id = roaster_details.emp_id 
             
                WHERE roaster_details.`late_time` != '00:00:00' and $conditions group by roaster_details.emp_id");
        $total_late = $late[0][0]['total_late'];
//        echo $this->RoasterDetail->getLastQuery();
//        pr($late);
//        exit;

        $this->set(compact('late'));
    }
    
    function emp_late_detail() {
        $this->loadModel('User');
        //Time take in variable for validation end 
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('RoasterDetail');
        $this->loadModel('Leave');
        //$date = new DateTime('now');
        // $d = new DateTime('first day of this month');
        // First day of this month
        $d = new DateTime('first day of this month');
        $d_f = $d->format('Y-m-d');

        $date = new DateTime('now');
        $date->modify('last day of this month');
        $d_l = $date->format('Y-m-d');
        $id = $this->params['pass'][0];
//        pr($this->request->data);
//        exit;
        $conditions = " roaster_details.date >=' " . $d_f . "' AND  roaster_details.date <='" . $d_l . "'";

        $late = $this->RoasterDetail->query("SELECT * FROM `roaster_details` 
                left join users on users.id = roaster_details.emp_id
                WHERE roaster_details.`late_time` != '00:00:00' AND emp_id = $id  AND $conditions");
       
//        echo $this->RoasterDetail->getLastQuery();
//        pr($late);
//        exit;
        $this->set(compact('late'));
    }

//pr('hello am I here :-)'); exit;
}

?>