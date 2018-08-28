<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');

require_once(APP . 'Vendor' . DS . 'class.upload.php');
App::import('Controller', 'Payments');
App::import('Controller', 'Reports');

class MovietimesController extends AppController {

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

    function add() {
        $this->loadModel('Mtfpc');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        if ($this->request->is('post')) {
            $this->Mtfpc->set($this->request->data);
            $y = $this->request->data['Mtfpc']['date']['year'];
            $m = $this->request->data['Mtfpc']['date']['month'];
            $d = $this->request->data['Mtfpc']['date']['day'];
            $day = $y . '-' . $m . '-' . $d;
            $this->request->data['Mtfpc']['date'] = $day;
            $this->request->data['Mtfpc']['user_id'] = $loggedUser['id'];
            $this->request->data['Mtfpc']['pc_id'] = $pc_info;
            $this->Mtfpc->save($this->request->data['Mtfpc']);
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Successfully added new record</strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect('manage');
        }
    }

    function add_movie() {
        $this->loadModel('Movie');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        if ($this->request->is('post')) {
            $this->Movie->set($this->request->data);
            $this->request->data['Movie']['user_id'] = $loggedUser['id'];

            $this->request->data['Movie']['pc_id'] = $pc_info;
            $category_count = count($this->request->data['Movie']['category']);

            if ($category_count == 1) {
                $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0];
            } elseif ($category_count == 2) {
                $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1];
            } elseif ($category_count == 3) {
                $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1] . ' ' . $this->request->data['Movie']['category'][2];
            } elseif ($category_count == 4) {
                $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1] . ' ' . $this->request->data['Movie']['category'][2] . ' ' . $this->request->data['Movie']['category'][3];
            } elseif ($category_count == 5) {
                $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1] . ' ' . $this->request->data['Movie']['category'][2] . ' ' . $this->request->data['Movie']['category'][3] . ' ' . $this->request->data['Movie']['category'][4];
            }
            $this->Movie->save($this->request->data['Movie']);
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Successfully added new movie</strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
    }

    function movie_mange() {
        $this->loadModel('Movie');
        $data = $this->Movie->query("SELECT * FROM movies");
        $this->set(compact('data'));
    }

    function movie_history() {
        $this->loadModel('MovieDetail');
        $this->loadModel('Movie');
        $id = $this->params['pass']['0'];
        $history = $this->MovieDetail->query("SELECT * FROM movie_details
                left join movies on movies.id = movie_details.movie_id
                 where movie_details.movie_id = '$id'");
        $data = $history;
        $data_movie = $this->Movie->query("SELECT * FROM movies where movies.id = '$id'");
        $dd = $data_movie[0]['movies']['category'];
        $words['movies'] = array_filter(explode(' ', $dd));
        $data_movie_r = $data_movie[0]['movies'];

        $this->set(compact('data', 'data_movie_r', 'words'));
    }

    function update_movie() {
        $this->loadModel('Movie');
        $this->Movie->id = $this->request->data['Movie']['id'];
        $loggedUser = $this->Auth->user();
        $category_count = count($this->request->data['Movie']['category']);

        if ($category_count == 1) {
            $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0];
        } elseif ($category_count == 2) {
            $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1];
        } elseif ($category_count == 3) {
            $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1] . ' ' . $this->request->data['Movie']['category'][2];
        } elseif ($category_count == 4) {
            $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1] . ' ' . $this->request->data['Movie']['category'][2] . ' ' . $this->request->data['Movie']['category'][3];
        } elseif ($category_count == 5) {
            $this->request->data['Movie']['category'] = $this->request->data['Movie']['category'][0] . ' ' . $this->request->data['Movie']['category'][1] . ' ' . $this->request->data['Movie']['category'][2] . ' ' . $this->request->data['Movie']['category'][3] . ' ' . $this->request->data['Movie']['category'][4];
        }

        $this->Movie->save($this->request->data['Movie']);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully updated </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function set_movie() {
        $this->loadModel('Mtfpc');
        $this->loadModel('MovieHistorie');
        $this->loadModel('Movie');
        $d = date("Y-m-d");
        $convert_date = strtotime($d);
        $name_day = date('l', $convert_date);

        //MovieHistorie data
        $movie_data = $this->MovieHistorie->query("SELECT * FROM movie_histories WHERE status = 'yes' AND  date = '$d'");

        if (!empty($movie_data)) {
            if (!empty($this->params['pass']['0'])) {
                $d = $this->params['pass']['0'];
                $movie_data = $this->MovieHistorie->query("SELECT * FROM movie_histories WHERE status = 'yes' AND  date = '$d'");
                $results = $movie_data[0]['movie_histories'];
            }
            $results = $movie_data[0]['movie_histories'];
        } else {
            $data = $this->Mtfpc->query("SELECT * FROM mtfpcs WHERE day_name = '$name_day'");
            unset($data[0]['mtfpcs']['date']);
            $results = $data[0]['mtfpcs'];
        }
        if (!empty($this->request->data)) {
            $date_s = $this->request->data['Mtfpc']['date']['year'] . '-' . $this->request->data['Mtfpc']['date']['month'] . '-' . $this->request->data['Mtfpc']['date']['day'];
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $date = $this->request->data['Mtfpc']['date']['year'] . '-' . $this->request->data['Mtfpc']['date']['month'] . '-' . $this->request->data['Mtfpc']['date']['day'];
            $convert_date = strtotime($date);
            $name_day = date('l', $convert_date);

            //searching data
            $data = $this->Mtfpc->query("SELECT * FROM mtfpcs WHERE day_name = '$name_day'");
            $movie_data = $this->MovieHistorie->query("SELECT * FROM movie_histories WHERE status = 'yes' AND  date = '$date'");

            if (!empty($movie_data)) {
                $results = $movie_data[0]['movie_histories'];
            } else {
                unset($data[0]['mtfpcs']['date']);
                $results = $data[0]['mtfpcs'];
            }
        }

        if (!empty($date_s)) {
            $date_s = $this->request->data['Mtfpc']['date']['year'] . '-' . $this->request->data['Mtfpc']['date']['month'] . '-' . $this->request->data['Mtfpc']['date']['day'];
        } else {
            $date_s = $d;
        }

        // movie load
        $alldata = $this->Movie->find('all');
        $list = array();
        foreach ($alldata as $row) {
            $id = $row['Movie']['id'];
            $name = $row['Movie']['name'];
            $release_year = $row['Movie']['release_year'];
            $hero = $row['Movie']['hero'];
            $heroin = $row['Movie']['heroin'];
            $category = $row['Movie']['category'];

            $list[$id] = $name . ' , ' . $release_year . ', ' . $hero . ', ' . $heroin . ', ' . $category;
        }
        $movie = $list;
        $this->set(compact('results', 'movie', 'date_format', 'date_s'));
    }

    function updatemovie_info() {
        $this->loadModel('MovieHistorie');
        $this->loadModel('MovieDetail');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $date_movie = date("Y-m-d");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $this->request->data['MovieHistorie']['user_id'] = $loggedUser['id'];
        $this->request->data['MovieHistorie']['pc_id'] = $pc_info;

        $date_4_search = date('Y-m-d', strtotime($this->request->data['MovieHistorie']['date']));
        $data_movie = $this->MovieHistorie->query("SELECT * FROM `movie_histories` WHERE movie_histories.date = '$date_4_search'");

        if (empty($data_movie)) {
            $this->request->data['MovieHistorie']['status'] = 'yes';
            $this->request->data['MovieHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['MovieHistorie']['date']));
            $m_history = $this->MovieHistorie->save($this->request->data['MovieHistorie']);
        } else {
            if (!empty($this->request->data['MovieHistorie']['id'])) {
                $this->request->data['MovieHistorie']['id'] = $this->request->data['MovieHistorie']['id'];
            }
            $this->request->data['MovieHistorie']['date'] = date('Y-m-d', strtotime($this->request->data['MovieHistorie']['date']));
            $m_history = $this->MovieHistorie->save($this->request->data['MovieHistorie']);
        }

        //MovieDetail insert start
        $this->MovieDetail->query("DELETE FROM movie_details WHERE movie_details.date = '$date_4_search'");

        $data = $this->request->data['MovieHistorie'];
        $array = array_values($data);
        $array1 = array_slice($array, 3, 18);
        $array2 = array_chunk($array1, 2);
        foreach ($array2 as $result) {
            $movie_history = array(
                'time' => $result['0'],
                'id' => $result['1']
            );
            $this->request->data['MovieDetail']['time'] = $movie_history['time'];
            $this->request->data['MovieDetail']['movie_id'] = $movie_history['id'];
            $this->request->data['MovieDetail']['user_id'] = $loggedUser['id'];
            $this->request->data['MovieDetail']['pc_id'] = $pc_info;
            $this->request->data['MovieDetail']['date'] = $date_4_search;
            $this->request->data['MovieDetail']['movie_history_id'] = $m_history['MovieHistorie']['id'];
            $this->MovieDetail->create();
            $this->MovieDetail->save($this->request->data['MovieDetail']);
        }
        //MovieDetail end
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Movie information updated succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect('set_movie' . DS . $date_4_search);
    }

    function movie_time() {
        $this->loadModel('Mtfpc');
        $data = $this->Mtfpc->query("SELECT * FROM mtfpcs ORDER BY mtfpcs.id ASC");
        $th = $this->Mtfpc->query("SELECT * FROM `mtfpcs` WHERE `m2t` !='00:00:00'");
        $data1 = $th[0]['mtfpcs'];
        $datas = $data;
        $this->set(compact('datas', 'data1'));
    }

    function editmovie() {
        $this->loadModel('Mtfpc');
        if ($this->request->is('post')) {
            $this->Mtfpc->set($this->request->data);
            $this->Mtfpc->id = $this->request->data['Mtfpc']['id'];
            $this->Mtfpc->save($this->request->data['Mtfpc']);
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Movie static information updated succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        return $this->redirect('movie_time');
    }

    function manage() {
        $this->loadModel('MovieHistorie');
        $this->loadModel('Mtfpc');
        $data = $this->MovieHistorie->query("SELECT * FROM movie_histories ORDER BY movie_histories.id ASC");
        $th = $this->Mtfpc->query("SELECT * FROM `mtfpcs` WHERE `m2t` !='00:00:00'");
        $data1 = $th[0]['mtfpcs'];
        $datas = $data;
        $this->set(compact('datas', 'data1'));
    }

//pr('hello am I here :-)'); exit;
}

?>