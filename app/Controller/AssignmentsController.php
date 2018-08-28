<?php
class AssignmentsController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {

        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {

        return true;
    }

    public function add() {
        $this->loadModel('Level');
        $this->loadModel('Subject');
        $this->loadModel('Chapter');
   
        $this->loadModel('Assignment');
       
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Assignment->set($this->request->data);
            if ($this->Assignment->validates()) {
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> New Assignment added succeesfully </strong>
			</div>';
             
                $this->Session->setFlash($msg);
                $user = $this->Session->read("Auth.User");
                $this->request->data['Assignment']['created_by'] = $user['id'];
               // $returnFromYoutube = $this->resumUploadYoutube($this->request->data['Study']['video']['name']);
                 if (!$this->Assignment->save($this->request->data['Assignment'])) {
                     $this->Session->setFlash($this->Assignment->error);
                 }
                return $this->redirect($this->referer());
            } else {
                 $this->Session->setFlash($this->generateError($this->Assignment->validationErrors));
            }
        }
        $levels = $this->Level->find('list');
        $subjects = $this->Subject->find('list', array('fields' => array('id', 'name', 'level_id'), 'order' => array('Subject.name' => 'ASC')));
        $chapters = $this->Chapter->find('list', array('fields' => array('id', 'name', 'subject_id'), 'order' => array('Chapter.name' => 'ASC')));

        $this->set(compact('levels', 'subjects', 'chapters'));
    }
    
         public function manage(){
          $this->loadModel('Assignment');
          $assignments= $this->Assignment->find('all');
          $this->set(compact('assignments'));
         
    }
    
        function edit($id = null) {
            $this->loadModel('Level');
	    $this->loadModel('Subject');
	    $this->loadModel('Chapter');
	   
           $this->loadModel('Assignment');
    
        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Assignment->set($this->request->data);
            if ($this->Assignment->validates()) {
                   $this->Assignment->id = $this->request->data['Assignment']['id'];
            $this->Assignment->save($this->request->data['Assignment']);
            $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Question updated succeesfully </strong>
    </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        else {
                 $this->Session->setFlash($this->generateError($this->Assignment->validationErrors));
            }


            } 
         
         
        if (!$this->request->data) {
            $data = $this->Assignment->findById($id);      
            $this->request->data = $data;
            
                $levels= $this->Level->find('list');
	        $subjects= $this->Subject->find('list',array('fields' =>array('id','name','level_id'),'order' => array('Subject.name' => 'ASC')));
	        $chapters= $this->Chapter->find('list',array('fields' =>array('id','name','subject_id'),'order' => array('Chapter.name' => 'ASC')));
	       
	        $this->set(compact('levels','subjects','chapters'));
        }
    }
    
         function block($id = null) {
        $this->loadModel('Assignment');
        $this->Assignment->id = $id;
        $this->Assignment->saveField("status", "blocked");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Assignment blocked succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }
    
        function approve($id = null) {
        $this->loadModel('Question');
        $this->Assignment->id = $id;
        $this->Assignment->saveField("status", "approved");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Assignment approved succeesfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect('manage');
    }
   

}

?>