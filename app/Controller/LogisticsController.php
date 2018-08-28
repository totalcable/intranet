<?php

/**
 * 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::import('Controller', 'Transactions'); // mention at top
App::import('Controller', 'Payments');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

class LogisticsController extends AppController {

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

    function add_product() {
        $this->loadModel('Product');
        if ($this->request->is('post')) {
            $this->Product->set($this->request->data);
            if ($this->Product->validates()) {
                $loggedUser = $this->Auth->user();
                $data['Product'] = array(
                    "user_id" => $loggedUser['id']);
                $this->Product->save($data);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Product insert succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect('add_product');
            } else {
                $msg = $this->generateError($this->Product->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
    }

    function ediproduct() {
        $this->loadModel('Product');
        if ($this->request->is('post')) {
            $this->Product->set($this->request->data);
            if ($this->Product->validates()) {
                $this->Product->id = $this->request->data['Product']['id'];
                $loggedUser = $this->Auth->user();
                $data['Product'] = array("user_id" => $loggedUser['id']);
                $this->Product->save($data);
                $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Product edited succeesfully </strong>
        </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Product->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $products = $this->Product->find('list', array('order' => array('Product.name' => 'ASC')));
        $this->set(compact('products'));
    }

    function manage() {
        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products'));
    }

    function delete($id = null) {
        $this->loadModel('Product');
        $this->Product->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Product deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function logistics_mainten() {
        $this->loadModel('LogisticsMaintenance');
        $this->loadModel('Product');
        if ($this->request->is('post')) {
            $this->LogisticsMaintenance->set($this->request->data);
            $loggedUser = $this->Auth->user();
            $requisition_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['requisition_date']));
            $from_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['from_date']));
            $to_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['to_date']));
            $received_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['received_date']));
            $to_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['to_date']));
            $product_receive_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['product_receive_date']));
            $data['LogisticsMaintenance'] = array(
                "user_id" => $loggedUser['id'],
                "requisition_date" => $requisition_date,
                "from_date" => $from_date,
                "to_date" => $to_date,
                "received_date" => $received_date,
                "product_receive_date" => $product_receive_date
            );
            $this->LogisticsMaintenance->save($data);
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Data insert succeesfully </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('logistics_mainten');
        }
        $products = $this->Product->find('list', array('order' => array('Product.name' => 'ASC')));
        $this->set(compact('products'));
    }

    function logistics_manage() {
        $this->loadModel('LogisticsMaintenance');
        $logistics = $this->LogisticsMaintenance->query("SELECT * FROM `logistics_maintenances` l
                LEFT JOIN products p on l.product_id = p.id
                LEFT JOIN users u on u.id = l.user_id ");
        $this->set(compact('logistics'));
    }

    function editlogistic() {
        $this->loadModel('LogisticsMaintenance');
        $this->loadModel('Product');
        $id = $this->params['pass'][0];
        if ($this->request->is('post')||$this->request->is('put')) {
            $this->LogisticsMaintenance->set($this->request->data);
            $this->LogisticsMaintenance->id = $id;
            $loggedUser = $this->Auth->user();
            $requisition_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['requisition_date']));
            $from_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['from_date']));
            $to_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['to_date']));
            $received_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['received_date']));
            $to_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['to_date']));
            $product_receive_date = date('Y/m/d', strtotime($this->request->data['LogisticsMaintenance']['product_receive_date']));
            $data['LogisticsMaintenance'] = array(
                "user_id" => $loggedUser['id'],
                "requisition_date" => $requisition_date,
                "from_date" => $from_date,
                "to_date" => $to_date,
                "received_date" => $received_date,
                "product_receive_date" => $product_receive_date
            );
            $this->LogisticsMaintenance->save($data);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Logistic update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }        
        $logistics = $this->LogisticsMaintenance->query("SELECT * FROM `logistics_maintenances` l
                LEFT JOIN products p on l.product_id = p.id
                LEFT JOIN users u on u.id = l.user_id where l.id =$id");
        $this->request->data = $this->LogisticsMaintenance->findById($id);
        $this->LogisticsMaintenance->set($logistics);
        $prod = $logistics[0]['p']['name'];
        $products = $this->Product->find('list', array('order' => array('Product.name' => 'ASC')));
        $this->set(compact('products', 'prod'));
    }
    
     function delete_logistic($id = null) {
        $this->loadModel('LogisticsMaintenance');
        $this->LogisticsMaintenance->delete($id);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Logistic deleted succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('logistics_manage');
    }
    
     function report() {
         $id = $this->params['pass'][0];
        $this->loadModel('LogisticsMaintenance');
        $logistics = $this->LogisticsMaintenance->query("SELECT * FROM `logistics_maintenances` l
                LEFT JOIN products p on l.product_id = p.id
                LEFT JOIN users u on u.id = l.user_id where l.id = $id");
        $this->set(compact('logistics'));
    }
    
    

}

?>