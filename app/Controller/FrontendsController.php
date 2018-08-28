<?php

class FrontendsController extends AppController {
    var $layout = 'public';
    public $ansSheet;
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Student',
                )
            ),
            'loginAction' => array(
                'controller' => 'frontends',
                'action' => 'login'
            ),
            'loginRedirect' => array('/index'),
            'logoutRedirect' => array('/index'),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logo', 'emailTest', 'detail', 'PFES', 'normallogin', 'isLooged_in', 'registration', 'assignment', 'OrderFromReseller');
        $student = $this->Auth->user();
        $this->ansSheet = 'AnswerSheet' . DS . $student['id'] . '.txt';
        if (!is_dir('AnswerSheet')) {
            mkdir('AnswerSheet');
        }
    }



    public function isAuthorized($user = null) {
        return true;
    }

    function isLooged_in() {
        $this->layout = 'ajax';
        $status = 'NO';
        if (count($this->Auth->user())) {
            $admin = $this->Auth->user();
            if ($admin['Role']['name'] == 'customer') {
                $status = 'YES';
            }
        }
        echo $status . ',' . $this->Session->read('lastUrl');
    }

    function logo() {
        $this->layout = 'ajax';
    }

    function registration() {
        $this->loadModel('Student');
        $this->loadModel('Role');
        $role = $this->Role->findByName('customer');
        $role_id = $role['Role']['id'];
        if ($this->request->is('post')) {
            $this->request->data['Student']['role_id'] = $role_id;
            $this->Student->set($this->request->data);
            if ($this->Student->validates()) {
                $this->Student->save($this->request->data['Student']);
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Registration completed succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                echo 'Registration Successful';
            } else {
                $errors = $this->generateError($this->Student->validationErrors) . '####';
                echo 'hasError' . $errors;
            }
        }
        // echo json_encode($this->request->data);  
    }

    function PFES() {
        
    }

    function login() {
        $this->loadModel('Student');
        $this->loadModel('Level');
        $levels = $this->Level->find('list');
        $this->set(compact('levels'));
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                if ($this->Auth->user('status') == 'active') {
                    // user is activated
                    $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Logged in succeesfully </strong>
			</div>';
                    $this->Session->setFlash($msg);
                    echo 'Login Successful####';
                } else {
                    // user is not activated
                    // log the user out
                    $this->Auth->logout();
                    $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>You are blocked, Contact with Adminstrator</strong>
                        </div>';

                    echo 'hasError' . $msg . '####';
                }
            } else {
                $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>Incorrect email/password combination. Try Again</strong>
                        </div>';
                echo 'hasError' . $msg . '####';
            }
        }
    }

    function normallogin() {
        $this->loadModel('Student');
        $this->loadModel('Level');
        $levels = $this->Level->find('list');
        $this->set(compact('levels'));
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                if ($this->Auth->user('status') == 'active') {
                    // user is activated
                    $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Logged in succeesfully </strong>
			</div>';
                } else {
                    // user is not activated
                    // log the user out
                    $this->Auth->logout();
                    $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>You are blocked, Contact with Adminstrator</strong>
                        </div>';
                }
            } else {
                $msg = '<div class="alert alert-error">
                           <button type="button" class="close" data-dismiss="alert">×</button>
                           <strong>Incorrect email/password combination. Try Again</strong>
                        </div>';
            }
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
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

    function OrderFromReseller($api_key) {
        $this->loadModel('Psetting');
        $products = $this->Psetting->find('all');
        $this->set(compact('products'));
        $this->render('index');
        if ($this->request->is('post')) {
            $this->index($api_key);
        }
    }

    function index($api_key = NULL) {

    }

    function levelContent() {
        if (isset($this->params['url']['l_id'])) {
            $l_id = $this->params['url']['l_id'];
            $s_id = $this->params['url']['s_id'];
            $c_id = $this->params['url']['c_id'];
            $return = '';
            switch (strtolower($this->params['url']['action'])) {
                case 'study':
                    $return = $this->study($l_id, $s_id, $c_id);
                    break;
                case 'practice':
                    $return = $this->practice($l_id, $s_id, $c_id);
                    break;
                case 'test':
                    $return = $this->test($l_id, $s_id, $c_id);
                    break;
            }

            $output['content'] = $return;
            $output['action'] = strtolower($this->params['url']['action']);
            return $output;
        }
    }

    function ssc() {
        $return = $this->levelContent();
        if (!isset($return['action']) || empty($return['action'])) {
            $this->view = strtolower($this->request->params['action']);
        } else {
            $this->view = $return['action'];
        }

        $contents = $return['content'];

        $this->set(compact('contents'));
    }

    function study($l_id, $s_id, $c_id) {
        $this->loadModel('Study');
        return $this->Study->find('all', array(
                    'conditions' => array('Study.level_id' => $l_id, 'Study.subject_id' => $s_id, 'Study.chapter_id' => $c_id)));
    }

    function practice($l_id, $s_id, $c_id) {
        $this->loadModel('Assignment');
        $assignments = $this->Assignment->find('all', array(
            'conditions' => array('Assignment.level_id' => $l_id, 'Assignment.subject_id' => $s_id, 'Assignment.chapter_id' => $c_id)));
        $info['level'] = $assignments[0]['Level']['name'];
        $info['subject'] = $assignments[0]['Subject']['name'];
        $info['chapter'] = $assignments[0]['Chapter']['name'];
        $ans = '';
        $ansTxtFile = '';
        $questions = array();
        foreach ($assignments as $NO => $assignment) {
            $asgnmnt = $assignment['Assignment'];
            $qpieces = explode(' ', $asgnmnt['question']);
            //pr($qpieces); 
            $criterias = explode(',', $asgnmnt['criteria']);
            $variable = array();
            $i = 0;
            $q = '';
            foreach ($qpieces as $key => $v) {
                if (trim($v) == '###') {
                    $minMax = explode('to', $criterias[$i++]);
                    $min = (int) $minMax[0];
                    $max = (int) $minMax[1];
                    $temp = rand($min, $max);
                    $variable[] = $temp;
                    $q .='  ' . $temp;
                } else {
                    $q .='  ' . $v;
                }
            }
            $questions[$NO]['question'] = $q;
            $input = '<input  class="span2"  type="text"><span class="typ-icon-cross wrong_ans hide" id="wrong' . $NO . '"> </span><span class=" icomoon-icon-checkmark-2 ok_ans hide" id="ok' . $NO . '" > </span>';
            $ans = str_replace('###', $input, $asgnmnt['ans']);
            $questions[$NO]['ans'] = $ans;
            $params = explode(',', $asgnmnt['parameter']);
            $equationsResult = explode('#', $asgnmnt['equation']);
            foreach ($params as $index => $param) {
                $$param = $variable[$index];
            }
            $equations = explode(',', $equationsResult[0]);
            $result = $equationsResult[1];
            foreach ($equations as $eqn) {
                eval($eqn . ';');
            }
            $ansTxtFile .= number_format((float) $$result, 2, '.', '') . ',';
        }

        $ansTxtFile .='#';
        $ansTxtFile = str_replace(',#', '', $ansTxtFile);

        file_put_contents($this->ansSheet, $ansTxtFile);
        $student = $this->Auth->user();

        $info['student_id'] = $student['id'];
        $info['student_name'] = $student['name'];
        $questions['info'] = $info;

        return $questions;
    }

    function test($l_id, $s_id, $c_id) {
        echo 'inside test ' . $l_id;
    }

    function hsc() {
        $return = $this->levelContent();
        if (!isset($return['action']) || empty($return['action'])) {
            $this->view = strtolower($this->request->params['action']);
        } else {
            $this->view = $return['action'];
        }

        $contents = $return['content'];

        $this->set(compact('contents'));
    }

    function assignment() {
        $this->loadModel('Assignment');
        $assignments = $this->Assignment->find('all');
        // pr($assignments); exit;
        $ans = '';
        $questions = array();
        foreach ($assignments as $NO => $assignment) {
            $asgnmnt = $assignment['Assignment'];
            $qpieces = explode(' ', $asgnmnt['question']);
            //pr($qpieces); 
            $criterias = explode(',', $asgnmnt['criteria']);
            $variable = array();
            $i = 0;
            $q = '';
            foreach ($qpieces as $key => $v) {
                if (trim($v) == '###') {
                    $minMax = explode('to', $criterias[$i++]);
                    $min = (int) $minMax[0];
                    $max = (int) $minMax[1];
                    $temp = rand($min, $max);
                    $variable[] = $temp;
                    $q .='  ' . $temp;
                } else {
                    $q .='  ' . $v;
                }
            }
            $questions[$NO]['question'] = $q;
            $input = '<input  class="span2"  type="text">';
            $ans = str_replace('###', $input, $asgnmnt['ans']);
            $questions[$NO]['ans'] = $ans;
            $params = explode(',', $asgnmnt['parameter']);
            $equationsResult = explode('#', $asgnmnt['equation']);
            foreach ($params as $index => $param) {
                $$param = $variable[$index];
            }
            $equations = explode(',', $equationsResult[0]);
            $result = $equationsResult[1];
            foreach ($equations as $eqn) {
                eval($eqn . ';');
            }
            $ans .= number_format((float) $$result, 2, '.', '') . ',';
        }
        //echo $ans; 
        $ans .='#';
        $ans = str_replace(',#', '', $ans);
        file_put_contents($this->ansSheet, $ans);
        $this->set(compact('questions'));
    }

    function tolet() {
        
    }

    function emailTest() {
        $this->layout = 'email';
    }

    function detail($pid = null, $api_key = null) {

        if ($pid) {
            $this->loadModel('Psetting');
            $this->loadModel('Review');
            $product = $this->Psetting->find('first', array(
                'conditions' => array(
                    'Psetting.product_id' => $pid
                )
                    )
            );
            $products = $this->Psetting->find('all', array(
                'conditions' => array(
                    'NOT' => array(
                        'Psetting.product_id' => array($pid)
                    ),
                )
            ));
            
            $reviews = $this->Review->find('all', array('conditions'=>array('status'=>'approved','product_id' => $pid)));
          
            $this->set(compact('product', 'products','reviews'));
        } else {
            $this->redirect('/');
        }
        if ($this->request->is('post')) {
            $this->index($api_key);
        }
    }

}

?>