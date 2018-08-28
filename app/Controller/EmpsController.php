<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');

require_once(APP . 'Vendor' . DS . 'class.upload.php');
App::import('Controller', 'Payments');
App::import('Controller', 'Reports');

class EmpsController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        parent::beforeFilter();

        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
            //  echo 'here'; exit; //(array('action' => 'deshboard'));
        }

        $this->Auth->allow('');
        // database name must be picture, attachment
        $this->img_config = array(
            'picture' => array(
                'image_ratio_crop' => true,
                'image_resize' => true,
                'image_x' => 50,
                'image_y' => 40
            ),
            //for attachment upload 
            'file' => array(
            ),
            'attachment' => array(
                'image_ratio_crop' => false,
            ),
            'parent_dir' => 'pictures',
            'target_path' => array(
                'picture' => WWW_ROOT . 'pictures' . DS,
                'attachment' => WWW_ROOT . 'attachment' . DS
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

    function processInvoice($img) {
        $upload = new Upload($img['name']);
        $upload->file_new_name_body = time();
        $upload->process($this->img_config['target_path']['attachment']);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            return $this->redirect($this->referer());
        }
        return $upload->file_dst_name;
    }

    function processAttachment($img) {
        $upload = new Upload($img['attachment']);
        $upload->file_new_name_body = time();
        foreach ($this->img_config['attachment'] as $key => $value) {
            $upload->$key = $value;
        }
        $upload->process($this->img_config['target_path']['attachment']);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $return['file_dst_name'] = $upload->file_dst_name;
        return $return;
    }

    function add() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Department');
        $this->loadModel('City');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Emp->set($this->request->data);
            if ($this->Emp->validates()) {
                $this->request->data['Emp']['user_id'] = $loggedUser['id'];
                $this->request->data['Emp']['pc_id'] = $pc_info;
                $this->Emp->save($this->request->data['Emp']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Record succeesfully inserted</strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('add');
            } else {
                $msg = $this->generateError($this->Emp->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
         
        $cities = $this->City->find('list', array('order' => array('City.name' => 'ASC')));
        $designations = $this->Designation->find('list', array('order' => array('Designation.name' => 'ASC')));
        $departments = $this->Department->find('list', array('order' => array('Department.name' => 'ASC')));
        $this->set(compact('designations', 'departments','cities'));
    }

    function manage() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('TicketDepartment');
        $emps = $this->Emp->query("SELECT * FROM emps
                left join designations on designations.id = emps.designation_id
                left join departments on departments.id = emps.department_id");
        $this->set(compact('emps'));
    }

    function editemp() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Department');
        $this->loadModel('City');
        $id = $this->params['pass']['0'];
        $emp_info = $this->Emp->findById($id);
        $emp = $emp_info['Emp'];
        if ($this->request->is('post')) {
            $this->Emp->set($this->request->data);
//            pr($this->request->data); exit;
            $this->Emp->id = $this->request->data['Emp']['id'];
           $this->request->data['Emp']['work_location'] = $this->request->data['Emp']['work_location'];
            
            $this->Emp->save($this->request->data['Emp']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Emp edited succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
//                return $this->redirect($this->referer());
            return $this->redirect('editemp' . DS . $this->request->data['Emp']['id']);
        }
        $designations = $this->Designation->find('list', array('order' => array('Designation.name' => 'ASC')));
        $departments = $this->Department->find('list', array('order' => array('Department.name' => 'ASC')));
        $cities = $this->City->find('list', array('order' => array('City.name' => 'ASC')));
//        pr($cities); exit;
        $this->set(compact('emp', 'designations', 'departments','cities'));
    }

    function individual_info() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Department');
        $this->loadModel('city');
        $id = $this->params['pass']['0'];
//        $emp_info = $this->Emp->findById($id);
        $emps = $this->Emp->query("SELECT * FROM emps
                left join designations on designations.id = emps.designation_id
                left join cities on cities.id = emps.city_id
                left join cities c on c.id = emps.ref_city_id
                left join departments on departments.id = emps.department_id where emps.id = $id");
//        $emp_data = $emps[0];
//        pr($emp_data); exit;
        $this->set(compact('emps'));
    }

    function update_emp() {
        $this->loadModel('Emp');
        if ($this->request->is('post')) {
            $this->Emp->set($this->request->data);

            $this->Emp->id = $this->request->data['Emp']['id'];
            
            $this->Emp->save($this->request->data['Emp']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Emp edited succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
//                return $this->redirect($this->referer());
            return $this->redirect('editemp' . DS . $this->request->data['Emp']['id']);
        }
    }
    
    
    function leave_manage() {
        $this->loadModel('Emp');
        $this->loadModel('Designation');
        $this->loadModel('Leave');
        $emps = $this->Emp->query("SELECT * FROM leaves
                left join designations on designations.id = emps.designation_id
                left join departments on departments.id = emps.department_id");
        $this->set(compact('emps'));
    }

//pr('hello am I here :-)'); exit;
}

?>