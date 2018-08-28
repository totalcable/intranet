<?php

/**
 * 
 */
class MessagesController extends AppController {
    var $layout = 'admin';

    public function beforeFilter() {
        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
            //  echo 'here'; exit; //(array('action' => 'deshboard'));
        }
        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {
        return true;
    }

    function add() {
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Message');
        if ($this->request->is('post')) {
            $this->Message->set($this->request->data);
            if ($this->Message->validates()) {
                if (empty($this->request->data['Message']['assign_id']) && empty($this->request->data['Message']['role_id'])) {
                    $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this message  </strong>
			</div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->referer());
                }
                $loggedUser = $this->Auth->user();
                $this->request->data['Message']['user_id'] = $loggedUser['id'];
                $this->Message->save($this->request->data['Message']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>  New Message added </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Message->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('users', 'roles'));
    }

    function manage() {
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Message');
        $data = $this->Message->query('SELECT m.id, message, u.name AS individual, r.name AS department, m.status, m.created
        FROM messages m LEFT JOIN users u ON u.id = m.assign_id
        LEFT JOIN roles r ON r.id = m.role_id ORDER BY m.id');
        $this->set(compact('data'));
    }

    function close($id = null) {
        $this->loadModel('Message');
        $this->Message->id = $id;
        $this->Message->saveField("status", "close");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Message close succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function open($id = null) {
        $this->loadModel('Message');
        $this->Message->id = $id;
        $this->Message->saveField("status", "open");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Message open succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }

    function edit($id = null) {
        $this->loadModel('Role');
        $this->loadModel('User');
        $this->loadModel('Message');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Message->set($this->request->data);
            if ($this->Message->validates()) {
                if (empty($this->request->data['Message']['assign_id']) && empty($this->request->data['Message']['role_id'])) {
                    $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this message  </strong>
			</div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->referer());
                }
                $this->Message->id = $id;
                $this->Message->save($this->request->data['Message']);
                $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Message updated succeesfully </strong>
	</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Message->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        if (!$this->request->data) {
            $data = $this->Message->findById($id);
            $this->request->data = $data;
            $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
            $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
            $this->set(compact('users', 'roles', 'data'));
        }
    }

}

?>