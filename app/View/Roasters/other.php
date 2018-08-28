 function setnewroastermorning() { //new roaster morning
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

            //RoasterDetail insert start
            $date_ = $r_history['RoasterHistorie']['date'];
            $shift_name = $r_history['RoasterHistorie']['shift_name_time'];
            $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_4_search' AND roaster_details.status = 1");

            foreach ($roaster_detail as $data_udate) {
                $this->request->data['RoasterDetail']['id'] = $data_udate['roaster_details']['id'];
                $this->request->data['RoasterDetail']['status'] = '0';
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
            }

            $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.shift_name_time = '$shift_name'");

//            foreach ($roaster_detail as $result) {
////             pr($result); exit;
//                $result['roaster_details']['status'] = '0';
////             pr($result['roaster_details']); exit;
//                $this->TempRoasterDetail->save($result['roaster_details']);
//            }


            $this->TempRoasterDetail->query("DELETE FROM temproasterdetails");
//            pr('here');
//            exit;
            $data = $r_history['RoasterHistorie'];
            $array = array_values($data);
            $array2 = array_slice($array, 4, 14);

            $array3 = array_filter($array2);
            $array4 = array_chunk($array3, 1);
// pr($array4); exit;
            foreach ($array4 as $result) {
                $id_history = array(
                    'emp_id' => $result
                );
//                $roaster_detail = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.status = 0 AND roaster_details.date = '$date_' limit 0,1");
//                echo $this->RoasterDetail->getLastQuery();
//                $roaster_detail = $this->TempRoasterDetail->query("Select * FROM temproasterdetails WHERE temproasterdetails.status = 0 AND temproasterdetails.date = $date_ limit 0,1");
//                $id = $roaster_detail[0]['temproasterdetails']['id'];
//                $this->request->data['TempRoasterDetail']['id'] = $id;
//                $this->request->data['TempRoasterDetail']['emp_id'] = $id_history['emp_id'][0];
//                $this->request->data['TempRoasterDetail']['status'] = '1';
//                $this->TempRoasterDetail->save($this->request->data['TempRoasterDetail']);

                $this->request->data['TempRoasterDetail']['emp_id'] = $id_history['emp_id'][0];
//                $this->request->data['TempRoasterDetail']['roaster_detail_id'] = $roaster_detail[0]['roaster_details']['id'];
                $this->request->data['TempRoasterDetail']['status'] = '0';
                $this->request->data['TempRoasterDetail']['date'] = $date_;
                $this->TempRoasterDetail->save($this->request->data['TempRoasterDetail']);
            }

            $data_RD = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.status !=1 ");
//             pr($data_RD); exit;
            foreach ($data_RD as $results) {
//                  pr($results['roaster_details']['id']); exit;
                $data_RD = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.status !=1 ");
                $this->request->data['TempRoasterDetail']['roaster_detail_id'] = $results['roaster_details']['id'];
                $this->request->data['TempRoasterDetail']['status'] = 1;
//                pr($this->request->data['TempRoasterDetail']); exit;
                $this->TempRoasterDetail->save($this->request->data['TempRoasterDetail']);
            }

            pr('gy');
            exit;


//            $data_RD = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' ");
//            foreach ($data_RD as $resul) {
//
//                $data_TRD = $this->TempRoasterDetail->query("SELECT * FROM `temproasterdetails` WHERE temproasterdetails.status = 0 ORDER BY `temproasterdetails`.`id` DESC LIMIT 0,1");
//
////                pr($result1);
////                exit;
//                $this->request->data['RoasterDetail']['emp_id'] = $result1['emp_id'];
//                $this->request->data['RoasterDetail']['status'] = $result1['status'];
//                pr($this->request->data['RoasterDetail']);
//                exit;
////                $this->request->data['TempRoasterDetail']['status'] = '1';
//                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
//                $this->TempRoasterDetail->savefield('status', 1);
//            }
// pr($data_RD);
//            exit;

            $data_TRD = $this->TempRoasterDetail->query("SELECT * FROM `temproasterdetails` WHERE temproasterdetails.status = 0 ORDER BY `temproasterdetails`.`id` DESC LIMIT 0,1");

            foreach ($data_TRD as $result1) {
                $data_RD = $this->RoasterDetail->query("Select * FROM roaster_details WHERE roaster_details.date = '$date_' AND roaster_details.status != 1 ");
//                $data_TRD = $this->TempRoasterDetail->query("SELECT * FROM `temproasterdetails` WHERE temproasterdetails.status = 0 ORDER BY `temproasterdetails`.`id` DESC LIMIT 0,1");
//                pr($result1);
//                exit;
                $this->request->data['RoasterDetail']['emp_id'] = $result1['temproasterdetails']['emp_id'];
//                $this->request->data['RoasterDetail']['status'] = $result1['status'];

                $this->request->data['RoasterDetail']['date'] = $result1['temproasterdetails']['date'];
                $this->request->data['RoasterDetail']['status'] = '1';
//                 pr($this->request->data['RoasterDetail']);
//                exit;
                $this->RoasterDetail->save($this->request->data['RoasterDetail']);
                $this->TempRoasterDetail->savefield('status', 1);
            }



            //RoasterDetail insert end
            $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Morning roaster update succeesfully </strong>
        </div>';
            $this->Session->setFlash($msg);
            return $this->redirect('set_roaster' . DS . $date_4_search);
        }
    }