<?php



class OtherspaymentsController extends AppController {

     var $layout = 'admin';

    // public $components = array('Auth');
    public function isAuthorized($user = null) {
        $sidebar = $user['Role']['name'];
        $this->set(compact('sidebar'));
        return true;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('process');

        $this->img_config = array(
            'check_image' => array(
                'image_ratio_crop' => false,
            ),
            'parent_dir' => 'check_images',
            'target_path' => array(
                'check_image' => WWW_ROOT . 'check_images' . DS
            )
        );
        if (!is_dir($this->img_config['parent_dir'])) {
            mkdir($this->img_config['parent_dir']);
        }
        foreach ($this->img_config['target_path'] as $img_dir) {
            if (!is_dir($img_dir)) {
                mkdir($img_dir);
            }
        }
    }

    function processImg($img, $type) {
//         pr($img); 
//         echo $type;
//         exit;
        $upload = new Upload($img[$type]);
        $upload->file_new_name_body = time();
        foreach ($this->img_config[$type] as $key => $value) {
            $upload->$key = $value;
        }
        $upload->process($this->img_config['target_path'][$type]);
        if (!$upload->processed) {
            $msg = $this->generateError($upload->error);
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $return['file_dst_name'] = $upload->file_dst_name;
        return $return;
    }

    function create() {
        $this->loadModel('User');
        $this->loadModel('OthersPayment');
        if ($this->request->is('post')) {
            $loggedUser = $this->Auth->user();
            $this->request->data['OthersPayment']['user_id'] = $loggedUser['id'];
            $formattedweddingdate = date_format(date_create($this->request->data['OthersPayment']['payment_date']), 'Y-m-d');
            $this->request->data['OthersPayment']['payment_date'] = $formattedweddingdate;
            $this->OthersPayment->save($this->request->data['OthersPayment']);
            $otherspaymentsMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
            $this->Session->setFlash($otherspaymentsMsg);
            return $this->redirect($this->referer());
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('technician'));
    }

    function manage($page=1) {
        $this->loadModel('User');
        $this->loadModel('OthersPayment');
        
//        $otherpayments = $this->OthersPayment->find('all');
        $offset = --$page*$this->per_page;
        $otherpayments = $this->OthersPayment->query("SELECT * FROM `others_payments`inner join users on"
                . " users.id = others_payments.technician_id "
                ." LIMIT ".$offset.",".$this->per_page);
        $total = $this->OthersPayment->query("SELECT COUNT(others_payments.id) as total FROM `others_payments`inner join users on"
                . " users.id = others_payments.technician_id ");
        $total_page = ceil($total[0][0]['total']/$this->per_page);
        $this->set(compact('otherpayments','total_page'));
    }

    function edit($id = null) {
        $this->loadModel('User');
        $this->loadModel('OthersPayment');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->OthersPayment->set($this->request->data);
            $this->OthersPayment->id = $id;
            $this->OthersPayment->save($this->request->data['OthersPayment']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> OthersPayment updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        if (!$this->request->data) {
            $data = $this->OthersPayment->findById($id);
            $this->request->data = $data;
            $users = $this->User->find('list', array('order' => array('User.name' => 'ASC')));
            $this->set(compact('users', 'data'));
        }
    }

    function cancel($id = null) {
        $this->loadModel('OthersPayment');
        $this->OthersPayment->id = $id;
        $this->OthersPayment->saveField("status", "canceled");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Others payment cancel succeesfully </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function done($id = null) {
        $this->loadModel('OthersPayment');
        $this->OthersPayment->id = $id;
        $this->OthersPayment->saveField("status", "done");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Others payment done succeesfully </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    public function individual_transaction_by_cash() {
        $this->loadModel('Transaction');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $cid = $this->request->data['Transaction']['cid'];
        $this->request->data['Transaction']['package_customer_id'] = $cid;
        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    function custom_payment() {
        $this->loadModel('Transaction');
        $this->loadModel('Role');
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->Transaction->set($this->request->data);
            if ($this->Transaction->validates()) {
                $temp = explode('/', $this->request->data['Transaction']['created']);
                $this->request->data['Transaction']['created'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1] . ' 00:00:00';
                // pr($this->request->data); exit;
                $this->Transaction->save($this->request->data['Transaction']);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Custom payment succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Transaction->validationErrors);
                $this->Session->setFlash($msg);
            }
        }

        $pay_to = $this->User->find('list', array('conditions' => array('OR' => array(array('User.role_id' => 9), array('User.role_id' => 11)))));
        $this->set(compact('pay_to'));
    }

}

?>