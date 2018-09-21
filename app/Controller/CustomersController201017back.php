<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');

require_once(APP . 'Vendor' . DS . 'class.upload.php');
App::import('Controller', 'Payments');
App::import('Controller', 'Reports');

class CustomersController extends AppController {

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

    function extrainvoice() {
        $extra_invoice = $this->processInvoice($this->request->data['Attachment']);
        $this->loadModel('Attachment');
        $loggedUser = $this->Auth->user();
        $data = array('name' => $extra_invoice, 'user_id' => $loggedUser['id'], 'package_customer_id' => $this->request->data['Attachment']['package_customer_id']);
        $this->Attachment->save($data);
        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Extra invoice added Successfully! </strong>
    </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function search($clicked = false, $param = null, $page = 1) {
        $this->loadModel('PackageCustomer');
        $data = array();
        $input = array();
        if ($this->request->is('post')) {
            $input = $this->request->data['PackageCustomer'];

            $param = str_replace(":", '>>>', $input['param']); //':' cuases problem. Hence this is used to reformat url so that cakephp can recognize it is as parmeter.

            if ($input['search'] == 4) {
                $state = (empty($input['state'])) ? 0 : $input['state'];
                $state = preg_replace("/[\r\n]+/", ' ', $state);
                $state = trim($state);

                $city = (empty($input['city'])) ? 0 : $input['city'];
                $city = preg_replace("/[\r\n]+/", " ", $city);
                $city = trim($city);

                $zip = (empty($input['zip'])) ? 0 : $input['zip'];
                $zip = preg_replace("/[\r\n]+/", " ", $zip);
                $zip = trim($zip);
                $param = $state . '#' . $city . "#" . $zip;
                $temp = $this->redirect(array('controller' => 'customers', 'action' => 'search', $input['search'], $param, 1));
            }
            $this->redirect(array('controller' => 'customers', 'action' => 'search', $input['search'], $param, 1));
        } else if ($clicked) {
            // remove ':' before passing
            $param = str_replace(">>>", ":", $param);
            //  echo $param; exit;
            if ($clicked == 4) {
                $params = explode("#", $param);
//                pr($params);
//                exit;
                $state = $params[0];
                $city = $params[1];
                $zip = $params[2];
                $data = $this->customerByloaction($state, $city, $zip, $clicked, $page);
            } else if ($clicked == 2) {
                $invoice = $param;
                $data = $this->searchbyinvoice($invoice, $clicked, $page);
            } else if ($clicked == 3) {
                $trxId = $param;
                $data = $this->searchBytrxId($trxId, $clicked, $page);
            } else if ($clicked == 5) {
                $ticketId = $param;
                $data = $this->searchByticketId($ticketId, $clicked, $page);
            } else {
                $input = array();
                $input['page'] = $page;
                $input['search'] = $clicked;
                $input['param'] = $param;
//                pr($param); exit;
                $data = $this->searchByParam($input);
            }
        }
        //customer status set start
        $s1 = $this->PackageCustomer->query("SELECT id, status FROM package_customers WHERE STATUS LIKE  '%active%'");
        $st1 = count($s1);

        $s2 = $this->PackageCustomer->query("SELECT id, status FROM package_customers WHERE STATUS LIKE  '%hold%'");
        $st2 = count($s2);

        $s3 = $this->PackageCustomer->query("SELECT id, status FROM package_customers WHERE STATUS LIKE  '%canceled%'");
        $st3 = count($s3);

        if (!empty($st1)) {
            $st2 = 0;
            $st3 = 0;
            $mac_status = 'Active';
        }

        if ($st2 > 0) {
            $st3 = 0;
            $mac_status = 'Hold';
        }

        if ($st3 > 0) {
            $mac_status = 'Canceled';
        }
        //customer status set end

        $admin_messages = $this->message();
        $states = $this->PackageCustomer->find('list', array('fields' => array('state', 'state'), 'group' => 'PackageCustomer.state', 'order' => array('PackageCustomer.state' => 'ASC')));
        $cities = $this->PackageCustomer->find('list', array('fields' => array('city', 'city'), 'group' => 'PackageCustomer.city', 'order' => array('PackageCustomer.city' => 'ASC')));
        $this->set(compact('mac_status', 'data', 'clicked', 'param', 'cities', 'states', 'admin_messages'));
    }

    function searchByParam($input = array()) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Track');
        $this->loadModel('CustomPackage');
        $this->loadModel('Psetting');
        $this->loadModel('Package');

        $param = $input['param'];
        $page = $input['page'];
        $data['customer'] = array();
        $data['package'] = array();

        if ($input['search'] == 1) {

            $data = $this->getCustomerByParam($page, $param, 'cell');

            if (count($data['customer']) == 0 || empty($param)) {
                $data = $this->getCustomerByParam($page, $param, 'first_name');
            }
            if (count($data['customer']) == 0 || empty($param)) {
                $data = $this->getCustomerByParam($page, $param, 'last_name');
            }
            if (count($data['customer']) == 0 || empty($param)) {

                $data = $this->getCustomerByParam($page, $param, 'mac');
            }
            if (count($data['customer']) == 0 || empty($param)) {
                // search by first and middle name
                $data = $this->getCustomerByParam($page, $param, 'fm_name');
            }
            if (count($data['customer']) == 0 || empty($param)) {
                // search by  middle name and last name
                $data = $this->getCustomerByParam($page, $param, 'ml_name');
            }

            if (count($data['customer']) == 0 || empty($param)) {
                // search by first name, middle name and last name
                $data = $this->getCustomerByParam($page, $param, 'full_name');
            }
        } else if ($input['search'] == 2) {
            $data = $this->searchBytrxId($param);
        } else if ($input['search'] == 3) {
            $data = $this->searchbyinvoice($param);
        }

        return $data;
    }

    function getCustomerByParam($page = 1, $param, $field) {
//        echo $param;
//        exit;

        $offset = --$page * $this->per_page;
        $param = str_replace(' ', '', $param);

        $condition = " package_customers." . $field . " LIKE '%$param%'";

        $name = array('first_name', 'last_name', 'middle_name');
//        pr($condition); exit;
        if ($field == "cell") {
            $regex = "/[()-]/i";
            $cell = preg_replace($regex, "", $param);
//            echo $param . ': ' . $cell;
//            exit;
            if (empty($cell)) {
                $cell = $param;
            }
            $condition = " package_customers.cell LIKE '%$cell%' OR package_customers.home LIKE '%$cell%' ";
        } else if (in_array($field, $name)) {
            $condition = " LOWER(package_customers.first_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.middle_name) LIKE '%" . strtolower($param) .
                    "%' OR LOWER(package_customers.last_name) LIKE '%" . strtolower($param) . "%'";
        } else if ($field == "fm_name") {
            $condition = " LOWER(CONCAT(package_customers.first_name,package_customers.middle_name)) LIKE '%" . strtolower($param) .
                    "%'";
        } else if ($field == "ml_name") {
            $condition = " LOWER(CONCAT(package_customers.middle_name,package_customers.last_name)) LIKE '%" . strtolower($param) .
                    "%'";
        }
        if ($field == "full_name") {
            $fullname = strtolower($param);
            $condition = "LOWER(CONCAT(package_customers.first_name,package_customers.middle_name,package_customers.last_name)) LIKE '%" . $fullname . "%'";
        }
//        pr($condition); exit;
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE $condition  LIMIT $offset,$this->per_page";

//           echo $sql . '<br>';
//        exit;

        $temp = $this->PackageCustomer->query($sql);
        $data = array();
        $customer = array();
        $package = array();
        foreach ($temp as $t) {
            $customer[] = $t['package_customers'];
            if (isset($t['psettings']['id'])) {
                $psetting = $t['psettings'];
                $data['packages']['name'] = $t['packages']['name'];
                $data['packages']['duration'] = $psetting['duration'];
                $data['packages']['charge'] = $psetting['amount'];
                $package[] = $data['packages'];
            } else if (isset($t['custom_packages']['id'])) {
                $psetting = $t['custom_packages'];
                $data['packages']['name'] = 'Custome Package';
                $data['packages']['duration'] = $psetting['duration'];
                $data['packages']['charge'] = $psetting['charge'];
                $package[] = $data['packages'];
            } else {
                $package[] = 0;
            }
        }
        $data = array();
        $data['customer'] = $customer;
        $data['package'] = $package;

        $sql = "SELECT COUNT(package_customers.id) as total FROM package_customers WHERE " . $condition;
        $temp = $this->PackageCustomer->query($sql);
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $data['total_page'] = $total_page;
        return $data;
    }

    function searchBytrxId($param) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $trinfo = $this->Transaction->query("SELECT * FROM `transactions` tr
            left join package_customers  pc on tr.package_customer_id =pc.id 
            where tr.trx_id = '$param'");
        return $trinfo;
    }

    function searchbyinvoice($data = array()) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $id = $data;
        $invoiceInfo = $this->Transaction->query("SELECT * FROM `transactions` tr
            left join package_customers  pc on tr.package_customer_id =pc.id 
            where tr.id = $id");
        return $invoiceInfo;
    }

    function customerByloaction($state, $city, $zip, $type, $page = 1) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $offset = --$page * $this->per_page;

        $city = trim($city);
        $city = strtolower($city);
        $state = trim($state);
        $state = strtolower($state);

        $sql = "SELECT * 
                FROM package_customers pc
                LEFT JOIN status_histories ON pc.id = status_histories.package_customer_id
                LEFT JOIN psettings ps ON ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id
                LEFT JOIN custom_packages cp ON cp.id = pc.custom_package_id ";
        $condition = '';

        if ($state) {
            $condition .= " LOWER(pc.state) LIKE '%$state%' AND";
        }
        if ($city) {
            $condition .=" LOWER(pc.city) LIKE '%$city%' AND";
        }
        if ($zip) {
            $condition .=" pc.zip= $zip AND";
        }

        if (empty($state) && empty($city) && empty($zip)) {
            $Msg = '<div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>You must select at least one criteria! </strong>
    </div>';
            $this->Session->setFlash($Msg);
            return $this->redirect($this->referer());
        }
        $condition .="###";
        $condition = str_replace("AND###", "", $condition);

        $sql .=' WHERE ' . $condition . " GROUP BY pc.id LIMIT $offset,$this->per_page";
// echo $sql; exit;
// pagination start
        $temp = $this->PackageCustomer->query("SELECT COUNT(pc.id) as total 
                FROM package_customers pc
                LEFT JOIN status_histories ON pc.id = status_histories.package_customer_id
                LEFT JOIN psettings ps ON ps.id = pc.psetting_id
                LEFT JOIN packages p ON p.id = ps.package_id
                LEFT JOIN custom_packages cp ON cp.id = pc.custom_package_id
                WHERE  $condition");

        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $data['data'] = $this->PackageCustomer->query($sql);
        $data['total_page'] = $total_page;
        return $data;
    }

    function updatePackageCustomerTable($data = array()) {
        if (isset($data['mac'])) {
            $data['mac'] = json_encode($data['mac']);
        }
        $this->loadModel('PackageCustomer');
        $this->loadModel('CustomPackage');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('StatusHistory');
        $loggedUser = $this->Auth->user();
        $tmsg = 'Information of  ' . $data['first_name'] . '  ' .
                $data['middle_name'] . '  ' .
                $data['last_name'] . ' has been updated';

        //For Custom Package data insert
        $data4CustomPackage['CustomPackage']['duration'] = $data['duration'];
        $data4CustomPackage['CustomPackage']['charge'] = $data['charge'];
        if (!empty($data['charge'])) {

            //save data into custom_package table
            $cp = $this->CustomPackage->save($data4CustomPackage);
            unset($cp['CustomPackage']['PackageCustomer']);

            //from custom_package table, save custom package id to package_customer table
            $data['custom_package_id'] = $cp['CustomPackage']['id'];
        }

        // if custom package is changed then custom_package_id will be reset to 0
        if (!isset($data['CustomPackage'])) {
            $data['custom_package_id'] = 0;
        }
        $this->PackageCustomer->save($data);
    }

    function message() {
        $this->loadModel('Message');
        $loggedUser = $this->Auth->user();
        $uid = $loggedUser['id'];
        $rid = $loggedUser['Role']['id'];
        $this->loadModel('Role');
        $sql = 'SELECT * FROM roles WHERE LOWER(roles.name)="general"';
        $temp = $this->Role->query($sql);
        $rid2 = $temp[0]['roles']['id'];
        $sql = "SELECT * FROM messages m
        LEFT JOIN users u ON u.id = m.user_id  WHERE (m.assign_id = $uid OR m.role_id = $rid OR m.role_id = $rid2) AND m.status ='open' ORDER BY m.id DESC";
        $admin_messages = $this->Message->query($sql);
        return $admin_messages;
    }

    function package_expdate_update() {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['package_customer_id'];
        $this->PackageCustomer->saveField("package_exp_date", $this->getFormatedDate($this->request->data['PackageCustomer']['package_exp_date']));

        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Package expire date updated Successfully! </strong>
        </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function update_status($id) {
        $data4statusHistory = array();
        $this->loadModel('StatusHistory');
        $this->loadModel('PackageCustomer');
        $loggedUser = $this->Auth->user();
        $data = array();
       
        foreach ($this->request->data['UpdateCustomer'] as $key => $arr) {
            $data[$key] = json_encode($arr);            
        }

        $string = str_replace(array('[',']'),'',$data);

        $this->request->data['StatusHistory']['id']=$data['id'];
        $this->request->data['StatusHistory']['mac']=  '[' .$string['mac'].']';
        $this->request->data['StatusHistory']['status']= '[' .$string['status'].']';
        $this->request->data['StatusHistory']['system']= '[' .$string['system'].']';
        $this->request->data['StatusHistory']['date']='[' .$string['date'].']';
        $this->request->data['StatusHistory']['user_id']='[' .$string['user_id'].']';      
        
        $this->request->data['StatusHistory']['package_customer_id'] = $id;
        $this->request->data['StatusHistory']['log_user_id'] = $loggedUser['id'];
        $this->StatusHistory->save($this->request->data['StatusHistory']);
        
         //slect last status of customer from status_histories and update package cusotmer status field
        $last_id = $this->StatusHistory->query("SELECT id, status FROM status_histories  WHERE package_customer_id = $id order by id desc limit 0,1");
        $id_l = $last_id[0]['status_histories']['id'];
       
        $s1 = $this->StatusHistory->query("SELECT id, status FROM status_histories  WHERE STATUS LIKE '%active%'  AND id = $id_l");
        $st1 = count($s1);

        $s2 = $this->StatusHistory->query("SELECT status FROM status_histories  WHERE STATUS LIKE  '%hold%'  AND id = $id_l");
        $st2 = count($s2);

        $s3 = $this->StatusHistory->query("SELECT status FROM status_histories  WHERE STATUS LIKE  '%canceled%'  AND id = $id_l");
        $st3 = count($s3);

        if (!empty($st1)) {
            $st2 = 0;
            $st3 = 0;
            $mac_status = 'Active';
        }

        if ($st2 > 0) {
            $st3 = 0;
            $mac_status = 'Hold';
        }

        if ($st3 > 0) {
            $mac_status = 'Canceled';
        }

        //update data in package customer
        $this->request->data['PackageCustomer']['id'] = $id;
        $this->request->data['PackageCustomer']['mac']=  '[' .$string['mac'].']';
        $this->request->data['PackageCustomer']['status']= '[' .$string['status'].']';
        $this->request->data['PackageCustomer']['system']= '[' .$string['system'].']';
        $this->request->data['PackageCustomer']['status'] = $mac_status;
        $this->PackageCustomer->save($this->request->data['PackageCustomer']);

        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Mac updated successfully! </strong>
        </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function save_mac() {
        $data4statusHistory = array();
        $this->loadModel('StatusHistory');
        $this->loadModel('PackageCustomer');
        $this->loadModel('MacHistory');
        $id = $this->params['pass'][0];
        $loggedUser = $this->Auth->user();
        $concate_data = array();

        //slect last mac info of a customer for update StatusHistory table
        $last_data = $this->StatusHistory->query("SELECT * FROM status_histories  WHERE package_customer_id = $id ORDER BY id DESC LIMIT 1");
        $dcode = $last_data[0]['status_histories'];

        //new mac info add
        $concate_data = $this->request->data['SaveMac'];

        $data1 = array(
            'mac' => $concate_data['mac'][0][0],
            'system' => $concate_data['system'][0][0],
            'status' => $concate_data['status'][0][0],
            'date' => $concate_data['date'][0][0],
            'user_id' => $concate_data['user_id'][0][0]
        );

        $data = array();
        foreach ($data1 as $key => $arr) {
            $data[$key] = json_encode($arr);
        }

        if (!empty($dcode['mac'])) {
            //Save data in StatusHistory(when old mac have)
            $this->request->data['StatusHistory']['package_customer_id'] = $id;
            $this->request->data['StatusHistory']['mac'] = '[' . $data['mac'] . ',' . substr($dcode['mac'], 1);
            $this->request->data['StatusHistory']['system'] = '[' . $data['system'] . ',' . substr($dcode['system'], 1);
            $this->request->data['StatusHistory']['status'] = '[' . $data['status'] . ',' . substr($dcode['status'], 1);
            $this->request->data['StatusHistory']['date'] = '[' . $data['date'] . ',' . substr($dcode['date'], 1);
            $this->request->data['StatusHistory']['user_id'] = '[' . $data['user_id'] . ',' . substr($dcode['user_id'], 1);
            $this->request->data['StatusHistory']['log_user_id'] = $loggedUser['id'];

            //update data in package customer
            $this->request->data['PackageCustomer']['id'] = $id;
            $this->request->data['PackageCustomer']['mac'] = '[' . $data['mac'] . ',' . substr($dcode['mac'], 1);
            $this->request->data['PackageCustomer']['system'] = '[' . $data['system'] . ',' . substr($dcode['system'], 1);
        } else {
            //Save data in StatusHistory
            $this->request->data['StatusHistory']['package_customer_id'] = $id;
            $this->request->data['StatusHistory']['mac'] = '[' . $data['mac'] . ']';
            $this->request->data['StatusHistory']['system'] = '[' . $data['system'] . ']';
            $this->request->data['StatusHistory']['status'] = '[' . $data['status'] . ']';
            $this->request->data['StatusHistory']['date'] = '[' . $data['date'] . ']';
            $this->request->data['StatusHistory']['user_id'] = '[' . $data['user_id'] . ']';
            $this->request->data['StatusHistory']['log_user_id'] = $loggedUser['id'];

            //update data in package customer
            $this->request->data['PackageCustomer']['id'] = $id;
            $this->request->data['PackageCustomer']['mac'] = '[' . $data['mac'] . ']';
            $this->request->data['PackageCustomer']['system'] = '[' . $data['system'] . ']';
        }
        $this->PackageCustomer->save($this->request->data['PackageCustomer']);
        $st_lastdata = $this->StatusHistory->save($this->request->data['StatusHistory']);
        $sh_id = $st_lastdata['StatusHistory']['id'];
        $pc = $st_lastdata['StatusHistory']['package_customer_id'];

        //slect last status of customer from status_histories and update package cusotmer status field
        $s1 = $this->StatusHistory->query("SELECT status FROM status_histories  WHERE STATUS LIKE  '%active%' AND id = $sh_id");
        $st1 = count($s1);

        $s2 = $this->StatusHistory->query("SELECT status FROM status_histories  WHERE STATUS LIKE  '%hold%' AND id = $sh_id");
        $st2 = count($s2);

        $s3 = $this->StatusHistory->query("SELECT status FROM status_histories  WHERE STATUS LIKE  '%canceled%' AND id = $sh_id");
        $st3 = count($s3);

        if (!empty($st1)) {
            $st2 = 0;
            $st3 = 0;
            $mac_status = 'Active';
        }

        if ($st2 > 0) {
            $st3 = 0;
            $mac_status = 'Hold';
        }

        if ($st3 > 0) {
            $mac_status = 'Canceled';
        }

        //update data in package customer
        $this->request->data['PackageCustomer1']['id'] = $pc;
        $this->request->data['PackageCustomer1']['status'] = $mac_status;
        $this->PackageCustomer->save($this->request->data['PackageCustomer1']);

        $Msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Mac Save Successfully! </strong>
        </div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function update_auto_recurring() {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');
        $dateObj = $this->request->data['AutoTransaction']['exp_date'];
        $this->request->data['AutoTransaction']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
        $this->PackageCustomer->id = $this->request->data['AutoTransaction']['package_customer_id'];
        $this->request->data['AutoTransaction']['r_form'] = $this->getFormatedDate($this->request->data['AutoTransaction']['r_form']);
        $this->request->data['AutoTransaction']['auto_recurring_failed'] = 0;
        unset($this->request->data['AutoTransaction']['package_customer_id']);

        $this->PackageCustomer->save($this->request->data['AutoTransaction']);
        $Msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Auto recurring updated Successfully! </strong>
</div>';
        $this->Session->setFlash($Msg);
        return $this->redirect($this->referer());
    }

    function updatecardinfo() {
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->request->data['Transaction']['user_id'] = $user_id;
        $this->request->data['Transaction']['status'] = 'update';
        $this->request->data['Transaction']['exp_date'] = $this->request->data['Transaction']['exp_date']['month'] . '/' . substr($this->request->data['Transaction']['exp_date']['year'], -2);

        if (strpos($this->request->data['Transaction']['card_no'], 'X') !== false) {
//Card number is not changed. So fetch previous card number
            $card = $this->Transaction->findById($this->request->data['Transaction']['id']);
            $this->request->data['Transaction']['card_no'] = $card['Transaction']['card_no'];
        }
        unset($this->request->data['Transaction']['id']);
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> Card information updated Successfully </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function getOpenInvoice($pcid = null) {
        $this->loadModel('Transaction');
        return $this->Transaction->query("SELECT *  FROM transactions 
left join package_customers on transactions.package_customer_id = package_customers.id
left join psettings on package_customers.psetting_id = psettings.id
left join packages on psettings.package_id = packages.id
left join custom_packages on package_customers.custom_package_id = custom_packages.id
WHERE  transactions.package_customer_id = $pcid and transactions.status = 'open' order by transactions.id DESC;");
    }

    function getStatements($id = null) {
        $statements = $this->Transaction->query("SELECT *
FROM transactions tr			
LEFT JOIN package_customers pc ON pc.id = tr.package_customer_id			
LEFT JOIN psettings ps ON ps.id = pc.psetting_id			
LEFT JOIN packages p ON p.id = ps.package_id			
LEFT JOIN custom_packages cp ON cp.id = pc.custom_package_id			
WHERE pc.id = $id AND (tr.status = 'open' OR tr.status = 'close' OR tr.status = 'approved' OR tr.status = 'Refund Successful')"
        );
        //echo $this->Level->getLastQuery();  
//echo $this->Transaction->getLastQuery(); exit;
        $return = array();
        foreach ($statements as $index => $statement) {
            $package = 'No package Selected';
            if (!empty($statement['ps']['id'])) {
                $package = $statement['ps']['name'];
            } else if (!empty($statement['cp']['id'])) {
                $package = $statement['cp']['duration'] . ' Months Custom Package ' . $statement['cp']['charge'] . '$';
            }

            $paid = $this->Transaction->query("SELECT *
FROM transactions tr			
WHERE transaction_id = " . $statement['tr']['id']
            );
            $return[] = array(
                'bill' => $statement['tr'],
                'payment' => $paid,
                'package' => $package
            );
        }
        return $return;
    }

    function edit($id = null) {
        $this->loadModel('StatusHistory');
        $this->loadModel('User');
        $this->loadModel('MacHistory');
        $pcid = $id;
        $loggedUser = $this->Auth->user();
        $user = $loggedUser['Role']['name'];
        if ($this->request->is('post') || $this->request->is('put')) {
// update package_customers table
            $this->request->data['PackageCustomer']['id'] = $id;
            $this->updatePackageCustomerTable($this->request->data['PackageCustomer']);
            $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> Customer information updated Successfully </strong>
</div>';
//$this->stbs_update($id);
            $this->Session->setFlash($msg);
        }
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('StatusHistory');
        $customer_info = $this->PackageCustomer->findById($pcid);
        $statusUpdateData = $this->StatusHistory->find('first', array('conditions' => array('StatusHistory.package_customer_id' => $id), 'order' => array('StatusHistory.id' => 'DESC')));
        $allStatus = array();

        if (!count($statusUpdateData)) {
            $allStatus['id'] = 0;
            $allStatus['package_customer_id'] = $id;
            foreach (json_decode($customer_info['PackageCustomer']['mac']) as $i => $value) {
                $allStatus[$i]['status'] = '';
                $allStatus[$i]['mac'] = $value;
                $allStatus[$i]['system'] = '';
                $allStatus[$i]['date'] = '';
                $allStatus[$i]['user_id'] = '';
            }
        } else {
            $arr = json_decode($statusUpdateData['StatusHistory']['status']);
            $records = count($arr);
            // pr($statusUpdateData);
            if ($records) {
                $allStatus['id'] = $statusUpdateData['StatusHistory']['id'];
                $allStatus['package_customer_id'] = $statusUpdateData['StatusHistory']['package_customer_id'];
                $mac = json_decode($statusUpdateData['StatusHistory']['mac']);
                $system = json_decode($statusUpdateData['StatusHistory']['system']);
                $status = json_decode($statusUpdateData['StatusHistory']['status']);
                $date = json_decode($statusUpdateData['StatusHistory']['date']);
                $user_id = json_decode($statusUpdateData['StatusHistory']['user_id']);
                for ($i = 0; $i < $records; $i++) {
                    $allStatus[$i]['status'] = $status[$i];
                    $allStatus[$i]['mac'] = $mac[$i];
                    $allStatus[$i]['system'] = $system[$i];
                    $allStatus[$i]['date'] = $date[$i];
                    $allStatus[$i]['user_id'] = $user_id[$i];
                }
            } else {
                $allStatus['id'] = 0;
                $allStatus['package_customer_id'] = $id;
                foreach (json_decode($customer_info['PackageCustomer']['mac']) as $i => $value) {
                    $allStatus[$i]['status'] = '';
                    $allStatus[$i]['mac'] = $value;
                    $allStatus[$i]['system'] = '';
                    $allStatus[$i]['date'] = '';
                    $allStatus[$i]['user_id'] = '';
                }
            }
        }
//pr($allStatus); exit;
        $this->request->data = $customer_info;
        $date = explode('/', $customer_info['PackageCustomer']['exp_date']);
        $yyyy = date('Y');
        $yy = substr($yyyy, 0, 2);
        $yyyy = 0;
        $mm = -1;
        if (count($date) == 2) {
            $yyyy = $yy . '' . $date[1];
            $mm = $date[0];
        }
        $customer_info['PackageCustomer']['exp_date'] = array('year' => $yyyy, 'month' => $mm);

        $this->request->data['AutoTransaction'] = $customer_info['PackageCustomer'];
        $payment = new PaymentsController();
        $latestcardInfo = $payment->getLastCardInfo($pcid);
        unset($customer_info['PackageCustomer']['email']);
        unset($customer_info['PackageCustomer']['exp_date']);
        unset($customer_info['PackageCustomer']['payable_amount']);
        unset($customer_info['PackageCustomer']['cvv_code']);
        unset($customer_info['PackageCustomer']['zip_code']);
        unset($customer_info['PackageCustomer']['id']);
        $this->request->data['Transaction'] = $customer_info['PackageCustomer'] + $latestcardInfo;
        $this->request->data['Transaction']['card_no'] = $this->formatCardNumber($this->request->data['Transaction']['card_no']);
        $nextPay = $this->Transaction->find('first', array('conditions' => array('Transaction.package_customer_id' => $pcid, 'Transaction.status' => 'open'), 'order' => array('Transaction.id' => 'DESC')));
        if (count($nextPay)) {
            $this->request->data['NextTransaction'] = $nextPay['Transaction'];
            $this->request->data['NextTransaction']['exp_date'] = $nextPay['Transaction']['next_payment'];
        }

        $statusHistories = $this->StatusHistory->find('all', array('conditions' => array('StatusHistory.package_customer_id' => $pcid)));

        $lastStatus = end($statusHistories);
//Show default value for custome package
        $customer_info['PackageCustomer']['date'] = $lastStatus['StatusHistory']['date'];
        $custom_package_charge = $customer_info['CustomPackage']['charge'];
        $custom_package_duration = $customer_info['CustomPackage']['duration'];

//Custom package checkmark
        $checkMark = FALSE;
        if (isset($custom_package_charge)) {
            $checkMark = TRUE;
        } else {
            $checkMark = FALSE;
        }
//Show mac and stb information which is already in database
        $macstb['mac'] = json_decode($customer_info['PackageCustomer']['mac']);
        $macstb['system'] = json_decode($customer_info['PackageCustomer']['system']);

        $c_acc_no = $customer_info['PackageCustomer']['c_acc_no'];
        $this->loadModel('Attachment');
        $transactions = $this->Transaction->find('all', array('conditions' => array('Transaction.package_customer_id' => $id)));
        $attachments = $this->Attachment->find('all', array('conditions' => array('Attachment.package_customer_id' => $id)));
        $status = $customer_info['PackageCustomer']['status'];
        $users = $this->User->find('list', array('order' => array('User.name' => 'ASC')));

        $this->set(compact('users', 'allStatus', 'status', 'transactions', 'customer_info', 'c_acc_no', 'macstb', 'custom_package_duration', 'checkMark', 'statusHistories'));

//        Ticket History
        $response = $this->getAllTickectsByCustomer($id);
        $data = $response['data'];
//        pr($data[0]['history']); exit;
        $users = $response['users'];
        $roles = $response['roles'];
        $this->set(compact('data', 'users', 'roles', 'customer_info'));
//        End Ticket History
        $this->loadModel('Package');
        $this->loadModel('Psetting');
        $packages = $this->Package->find('all');
        $packageList = array();
        foreach ($packages as $index => $package) {
            $psettings = $this->Psetting->find('all', array('conditions' => array('package_id' => $package['Package']['id'])));
            $psettingList = array();
            foreach ($psettings as $psetting) {
                $id = $psetting['Psetting']['id'];
                $psettingList[$id] = $psetting['Psetting']['name'];
            }
            $pckagename = $package['Package']['name'];
            $packageList[$pckagename] = $psettingList;
        }
        $ym = $this->getYm();
        $this->loadModel('Transaction');
        $invoices = $this->getOpenInvoice($pcid);
        $statements = $this->getStatements($pcid);

//Need this code
//       $data = $this->MacHistory->find('all', array('conditions' => array('package_customer_id' => $pcid)));
//      
//        $filteredData = array();
//
//        foreach ($data as $single) {
//                $mac[] = $single['MacHistory']['mac'];
//            $user_id[] = $single['MacHistory']['installed_by'];
//            $installation_date[] = $single['MacHistory']['installation_date'];
//        }
//
//        if (!empty($user_id)) {
//            
//            
//            $filteredData['mac'] = $mac;
//            $filteredData['user_id'] = $user_id;
//            $filteredData['installation_date'] = $installation_date;
//            $this->request->data['PackageCustomer'] = $filteredData;
//
//        }
//             pr($this->request->data); exit;



        $this->set(compact('mac_status', 'filteredData', 'invoices', 'statements', 'packageList', 'psettings', 'ym', 'custom_package_charge', 'user', 'attachments'));
    }

    function adjustmentMemo($id = null) {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $this->request->data['Transaction']['next_payment'] = $this->getFormatedDate($this->request->data['Transaction']['next_payment']);
        $result = array();
        if (!empty($this->request->data['Transaction']['attachment']['name'])) {
            $result = $this->processAttachment($this->request->data['Transaction'], 'attachment');
            $this->request->data['Transaction']['attachment'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['attachment'] = '';
        }
        if (!empty($this->request->data['Transaction']['phone'])) {
            $sql = 'SELECT * FROM package_customers WHERE cell = "' . trim($this->request->data['Transaction']['phone']) .
                    '" OR home = "' . trim($this->request->data['Transaction']['phone']) . '"';
            $data = $this->PackageCustomer->query($sql);
            if (count($data) == 0) {
                $msg = '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>This referral record does not exist </strong></div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $this->loadModel('Referral');
                $temp = array('referred' => $id,
                    'reffered_by' => $data[0]['package_customers']['id'],
                    'user_id' => $loggedUser['id'],
                    'note' => $this->request->data['Transaction']['note']
                );
                $this->Referral->save($temp);
                $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Succeesfully saved </strong></div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }
        }
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Succeesfully saved </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function send($param = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
//        $this->loadModel('Setting');

        $sql = "SELECT * FROM transactions 
left join package_customers on transactions.package_customer_id = package_customers.id
left join psettings on package_customers.psetting_id = psettings.id
left join packages on psettings.package_id = packages.id
left join custom_packages on package_customers.custom_package_id = custom_packages.id
WHERE  transactions.id = $param";
        $invoices = $this->Transaction->query($sql);
//                
//        
//        $emails = $this->Setting->find('first', array(
//            'conditions' => array('field' => 'email')
//        ));

        $from = 'si.totaltvs@gmail.com';
        $subject = "Invoice of Transaction";
        $cus_name = $invoices[0]['package_customers']['middle_name'];
        $email_custom = $invoices[0]['package_customers']['email'];
        $to = array('farukmscse@gmail.com');

        $phone_num = $invoices[0]['transactions']['phone'];
        $description = $invoices[0]['package_customers']['comments'];
        $mail_content = array($invoices[0]);
//sendEmail($from,$name,$to,$subject,$body)
        sendInvoice($from, $cus_name, $to, $subject, $mail_content);
// End send mail
//        $this->set(compact('invoices'));
        return $this->redirect(array('controller' => 'customers', 'action' => 'edit', $invoices[0]['package_customers']['id']));
    }

    function registration() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->loadModel('CustomPackage');
        $this->loadModel('PaidCustomer');
        $this->loadModel('Country');
        $this->loadModel('Comment');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Issue');
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['PackageCustomer']['status'] = 'requested';
            if ($this->request->data['PackageCustomer']['shipment_equipment'] == 'OTHER') {
                $this->request->data['PackageCustomer']['shipment_equipment'] = $this->request->data['PackageCustomer']['shipment_equipment_other'];
            }
//For Custom Package data insert//
            if (!empty($this->request->data['PackageCustomer']['charge'])) {
                $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
                $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];
                $cp = $this->CustomPackage->save($data4CustomPackage);
                unset($cp['CustomPackage']['PackageCustomer']);
                $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
            }
            $this->PackageCustomer->set($this->request->data);

            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
            if (!empty($this->request->data['PackageCustomer']['attachment']['name'])) {
                $result = $this->processAttachment($this->request->data['PackageCustomer']);
                $this->request->data['PackageCustomer']['attachment'] = $result['file_dst_name'];
            } else {
                $this->request->data['PackageCustomer']['attachment'] = '';
            }
            $date = date('Y-m-d');
            $this->request->data['PackageCustomer']['date'] = $date;
            $status = 'sales done';
            if ($this->request->data['PackageCustomer']['follow_up']) {
                $status = 'sales query';
            }
            if ($this->request->data['PackageCustomer']['shipment']) {
                $status = 'shipment';
            }
            $this->request->data['PackageCustomer']['user_id'] = $loggedUser['id'];
            $pc = $this->PackageCustomer->save($this->request->data['PackageCustomer']);

            $data4statusHistory = array();
            $data4statusHistory['StatusHistory'] = array(
                'package_customer_id' => $pc['PackageCustomer']['id'],
                'date' => date('Y-m-d'),
                'status' => $status
            );
            $this->StatusHistory->save($data4statusHistory);
//            data for comment
            $comment['Comment']['package_customer_id'] = $pc['PackageCustomer']['id'];
            $loggedUser = $this->Auth->user();
            $comment['Comment']['user_id'] = $loggedUser['id'];
            $comment['Comment']['content'] = $this->request->data['PackageCustomer']['comments'];
            $this->Comment->save($comment);

            $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> New customer entry succeesful </strong>
</div>';
            $this->Session->setFlash($msg);
//            $this->stbs_update($pc['PackageCustomer']['id']);
            return $this->redirect($this->referer());
        }

//******************************
        $this->loadModel('Package');
        $this->loadModel('Psetting');
        $packages = $this->Package->find('all');
        $packageList = array();
        foreach ($packages as $index => $package) {
            $psettings = $this->Psetting->find('all', array('conditions' => array('package_id' => $package['Package']['id'])));
            $psettingList = array();
            foreach ($psettings as $psetting) {
                $id = $psetting['Psetting']['id'];
                $psettingList[$id] = $psetting['Psetting']['name'];
            }
            $pckagename = $package['Package']['name'];
            $packageList[$pckagename] = $psettingList;
        }
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE package_customers.id = '" . $id . "'";
        $temp = $this->PackageCustomer->query($sql);
        $ym = $this->getYm();
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'issues'));
//*************** End Package List ******************
        $ym = $this->getYm();
        $this->set(compact('ym'));
//   $this->loadModel('User');
//   $this->loadModel('Role');
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
    }

    function edit_registration($id = null) {
        $pcid = $id;
        $this->loadModel('PackageCustomer');
        $this->loadModel('CustomPackage');
        $this->loadModel('Comment');
        $this->loadModel('Issue');
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post') || $this->request->is('put')) {
//            pr($this->request->data); exit;
            $this->PackageCustomer->set($this->request->data);
            $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
//For Custom Package data insert
            if (!empty($this->request->data['PackageCustomer']['charge'])) {
                $data4CustomPackage['CustomPackage']['duration'] = $this->request->data['PackageCustomer']['duration'];
                $data4CustomPackage['CustomPackage']['charge'] = $this->request->data['PackageCustomer']['charge'];
                $cp = $this->CustomPackage->save($data4CustomPackage);
                unset($cp['CustomPackage']['PackageCustomer']);
                $this->request->data['PackageCustomer']['custom_package_id'] = $cp['CustomPackage']['id'];
            }
            $this->PackageCustomer->set($this->request->data);
            $this->PackageCustomer->id = $id;
            $dateObj = $this->request->data['PackageCustomer']['exp_date'];
            $this->request->data['PackageCustomer']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);

            if (!empty($this->request->data['PackageCustomer']['attachment']['name'])) {
                $result = $this->processAttachment($this->request->data['PackageCustomer']);
                $this->request->data['PackageCustomer']['attachment'] = $result['file_dst_name'];
            } else {
                $this->request->data['PackageCustomer']['attachment'] = '';
            }
            $this->request->data['PackageCustomer']['user_id'] = $loggedUser['id'];
//            pr($this->request->data['PackageCustomer']); exit;
            $this->PackageCustomer->save($this->request->data['PackageCustomer']);
//            $this->stbs_update($id);
//update last comment
            if ($this->request->data['PackageCustomer']['comment_id']) {
                $this->Comment->id = $this->request->data['PackageCustomer']['comment_id'];
            }
            $loggedUser = $this->Auth->user();
            $commentData['Comment']['user_id'] = $loggedUser['id'];
            $commentData['Comment']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
            $commentData['Comment']['content'] = $this->request->data['PackageCustomer']['comments'];
            $this->Comment->save($commentData);
            $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> Cutomer Information update succeesfully </strong>
</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $data = $this->PackageCustomer->findById($id);
        $date = explode('/', $data['PackageCustomer']['exp_date']);
        $yyyy = date('Y');
        $yy = substr($yyyy, 0, 2);
        $yyyy = 0;
        $mm = -1;
        if (count($date) == 2) {
            $yyyy = $yy . '' . $date[1];
            $mm = $date[0];
        }
        $data['PackageCustomer']['exp_date'] = array('year' => $yyyy, 'month' => $mm);
        $this->request->data = $data;
//Show Package List 
//********************************************************************************************************
        $this->loadModel('Package');
        $this->loadModel('Psetting');
        $packages = $this->Package->find('all');
        $packageList = array();
        foreach ($packages as $index => $package) {
            $psettings = $this->Psetting->find('all', array('conditions' => array('package_id' => $package['Package']['id'])));
            $psettingList = array();
            foreach ($psettings as $psetting) {
                $id = $psetting['Psetting']['id'];
                $psettingList[$id] = $psetting['Psetting']['name'];
            }
            $pckagename = $package['Package']['name'];
            $packageList[$pckagename] = $psettingList;
        }
        $sql = "SELECT * FROM package_customers "
                . "LEFT JOIN psettings ON package_customers.psetting_id = psettings.id"
                . " LEFT JOIN packages ON psettings.package_id = packages.id"
                . " LEFT JOIN custom_packages ON package_customers.custom_package_id = custom_packages.id" .
                " WHERE package_customers.id = '" . $id . "'";
        $temp = $this->PackageCustomer->query($sql);

        $ym = $this->getYm();



        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'latestcardInfo', 'issues'));

//        $this->set(compact('packageList', 'psettings', 'selected', 'ym', 'custom_package_charge', 'latestcardInfo'));
//*************** End Package List ****************************************************************************************
        $ym = $this->getYm();

        $lastComment = $this->Comment->find('first', array('conditions' => array('package_customer_id' => $pcid),
            'order' => array('id' => 'DESC')));

        if (count($lastComment)) {
            $lastComment = $lastComment['Comment'];
        } else {
            $lastComment['content'] = '';
            $lastComment['id'] = 0;
        }
        $this->set(compact('ym', 'lastComment'));
    }

    function followup() {
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE pc.status = 'requested' AND pc.follow_up = 1");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $this->set(compact('filteredData'));
    }

    function ready_installation() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join users ut on pc.technician_id = ut.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE pc.status = 'ready'  OR (pc.follow_up=0 AND pc.status ='requested' AND 
pc.status != 'old_ready' ) AND shipment =0  ORDER BY pc.created DESC LIMIT 100");

        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }

                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }

                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }

                $filteredData[$index]['issue'] = array();
                if (!empty($data['i']['id'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issue'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));


        $this->set(compact('filteredData', 'technician'));
    }

    function schedule_done() {
        $this->loadModel('User');
        $loggedUser = $this->Auth->user();
        $id = $loggedUser['id'];
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc  
WHERE pc.technician_id = $id and pc.status = 'scheduled'");
        $this->set(compact('allData'));
    }

    function repair($id = null) {

        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
WHERE pc.id=$id");
// echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));

        $this->set(compact('filteredData', 'technician'));
    }

    function box_change($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['id'];
        $this->PackageCustomer->technician_id = $this->request->data['PackageCustomer']['technician_id'];
        $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);

        $this->request->data['PackageCustomer']['from'] = $datrange['start'];
        $this->request->data['PackageCustomer']['to'] = $datrange['end'];
        $loggedUser = $this->Auth->user();
        $this->request->data['PackageCustomer']['user_id'] = $loggedUser['id'];
        $this->PackageCustomer->save($this->request->data);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function done($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->PackageCustomer->id = $this->request->data['Comment']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "done");
        $this->Comment->save($this->request->data);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function update_payment($id = null) {
        $this->loadModel('PackageCustomer');
        $loggedUser = $this->Auth->user();
        $id = $loggedUser['id'];
        $this->PackageCustomer->id = $this->request->data['NextTransaction']['package_customer_id'];
        $data = array();
        $data['PackageCustomer'] = array(
            'exp_date' => $this->getFormatedDate($this->request->data['NextTransaction']['exp_date']),
// when change package exp date then these fields will be update
//            'ticket_generated' => 0,
//            'invoice_no' => 0,
//            'invoice_created' => 0,
//            'printed' => 0,
//            'auto_r' => 'no'
        );
        if ($this->request->data['NextTransaction']['discount'] == '') {
            $this->request->data['NextTransaction']['discount'] = 0;
        }
        $pc_data = $this->PackageCustomer->save($data);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);

        $data['Transaction'] = array(
            'user_id' => $id,
            'package_customer_id' => $this->request->data['NextTransaction']['package_customer_id'],
            'note' => $this->request->data['NextTransaction']['note'],
            'discount' => $this->request->data['NextTransaction']['discount'],
            'status' => 'open',
            'next_payment' => $pc_data['PackageCustomer']['exp_date'],
            'payable_amount' => $this->request->data['NextTransaction']['payable_amount']
        );
        $this->generateInvoice($data['Transaction']);
        return $this->redirect($this->referer());
    }

    function ready($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Comment');
        $this->PackageCustomer->id = $this->request->data['Comment']['package_customer_id'];
        $this->PackageCustomer->saveField("status", "ready");
        $this->Comment->save($this->request->data);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>  succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function shedule_assian($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Installation');
        $loggedUser = $this->Auth->user();
//        $date = $this->request->data['PackageCustomer']['schedule_date'] . ' ' . $this->request->data['PackageCustomer']['seTime'];
        $temp = explode('/', $this->request->data['PackageCustomer']['schedule_date']); //date format change and insert
        $dateformat = $this->request->data['PackageCustomer']['schedule_date'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1];
        $date = $dateformat . ' ' . $this->request->data['PackageCustomer']['seTime'];
        $this->request->data['Installation']['assign_by'] = $loggedUser['id'];
        $this->request->data['Installation']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
        $this->request->data['Installation']['schedule_date'] = $date;
        $this->request->data['Installation']['user_id'] = $this->request->data['PackageCustomer']['technician_id'];
        $this->request->data['Installation']['status'] = 'scheduled';
        $this->request->data['PackageCustomer']['schedule_date'] = $date;
        $this->request->data['PackageCustomer']['status'] = 'scheduled';
        $this->PackageCustomer->save($this->request->data);
        $this->Installation->save($this->request->data);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> succeesfully done </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function shipment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id                    
left join users ut on pc.technician_id = ut.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE pc.shipment = 1 AND pc.status ='requested'");
// echo $sql; exit;
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                $filteredData[$index]['issue'] = array();
                if (!empty($data['i']['id'])) {
                    $temp = array('name' => $data['i']);
                    $filteredData[$index]['issue'][] = $temp;
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function troubleshot_shipment() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on pc.user_id = u.id
left join users ut on pc.technician_id = ut.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE pc.shipment = 2 and approved = 0 and pc.status ='requested' ");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function cancelrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[0] . '/' . $start[1] . '/' . $start[2];
            $end = explode('-', $datrange['end']);
            $end = $end[0] . '/' . $end[1] . '/' . $end[2];
            $conditions = 'pc.date >="' . $start . '" AND pc.date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE LOWER(pc.status) like '%Request to cancel%' and $conditions";
//            echo $sql; exit;
            $allData = $this->PackageCustomer->query($sql);
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
                    if (!empty($data['c']['content'])) {
//  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$pd] = 'set';

                    $filteredData[$index]['customers'] = $data['pc'];
                    $filteredData[$index]['users'] = $data['u'];

                    $filteredData[$index]['package'] = array(
                        'name' => 'No package dealings',
                        'duration' => 'Not Applicable',
                        'amount' => 'not Applicable'
                    );

                    if (!empty($data['i']['id'])) {
                        $filteredData[$index]['issue'] = $data['i'];
                    }

                    if (!empty($data['ps']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['ps']['name'],
                            'duration' => $data['ps']['duration'],
                            'amount' => $data['ps']['amount']
                        );
                    }
                    if (!empty($data['cp']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['cp']['duration'] . ' months custom package',
                            'duration' => $data['cp']['duration'],
                            'amount' => $data['cp']['charge']
                        );
                    }
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function holdrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[0] . '/' . $start[1] . '/' . $start[2];
            $end = explode('-', $datrange['end']);
            $end = $end[0] . '/' . $end[1] . '/' . $end[2];
            $conditions = 'pc.date >="' . $start . '" AND pc.date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE LOWER(pc.status) like '%hold%' and $conditions";
            $allData = $this->PackageCustomer->query($sql);
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$pd] = 'set';

                    $filteredData[$index]['customers'] = $data['pc'];
                    $filteredData[$index]['users'] = $data['u'];

                    $filteredData[$index]['package'] = array(
                        'name' => 'No package dealings',
                        'duration' => 'Not Applicable',
                        'amount' => 'not Applicable'
                    );

                    if (!empty($data['ps']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['ps']['name'],
                            'duration' => $data['ps']['duration'],
                            'amount' => $data['ps']['amount']
                        );
                    }
                    if (!empty($data['cp']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['cp']['duration'] . ' months custom package',
                            'duration' => $data['cp']['duration'],
                            'amount' => $data['cp']['charge']
                        );
                    }
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;

            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function unholdrequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[0] . '/' . $start[1] . '/' . $start[2];
            $end = explode('-', $datrange['end']);
            $end = $end[0] . '/' . $end[1] . '/' . $end[2];
            $conditions = 'pc.date >="' . $start . '" AND pc.date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE LOWER(pc.status) like '%unhold%' and $conditions";
            $allData = $this->PackageCustomer->query($sql);
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                    if (!empty($data['c']['content'])) {
//  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);

                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$pd] = 'set';

                    $filteredData[$index]['customers'] = $data['pc'];
                    $filteredData[$index]['users'] = $data['u'];

                    $filteredData[$index]['package'] = array(
                        'name' => 'No package dealings',
                        'duration' => 'Not Applicable',
                        'amount' => 'not Applicable'
                    );

                    if (!empty($data['ps']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['ps']['name'],
                            'duration' => $data['ps']['duration'],
                            'amount' => $data['ps']['amount']
                        );
                    }
                    if (!empty($data['cp']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['cp']['duration'] . ' months custom package',
                            'duration' => $data['cp']['duration'],
                            'amount' => $data['cp']['charge']
                        );
                    }
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function reconnectionRequest() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {

            $datrange = json_decode($this->request->data['PackageCustomer']['daterange'], true);
            $start = explode('-', $datrange['start']);
            $start = $start[0] . '/' . $start[1] . '/' . $start[2];
            $end = explode('-', $datrange['end']);
            $end = $end[0] . '/' . $end[1] . '/' . $end[2];
            $conditions = 'pc.date >="' . $start . '" AND pc.date <="' . $end . '"';
            $sql = "SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE LOWER(pc.status) like '%reconnection%' and $conditions";
            $allData = $this->PackageCustomer->query($sql);
            $filteredData = array();
            $unique = array();
            $index = 0;
            foreach ($allData as $key => $data) {
                $pd = $data['pc']['id'];
                if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                    if (!empty($data['c']['content'])) {
//  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);

                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$pd] = 'set';

                    $filteredData[$index]['customers'] = $data['pc'];
                    $filteredData[$index]['users'] = $data['u'];

                    $filteredData[$index]['package'] = array(
                        'name' => 'No package dealings',
                        'duration' => 'Not Applicable',
                        'amount' => 'not Applicable'
                    );

                    if (!empty($data['ps']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['ps']['name'],
                            'duration' => $data['ps']['duration'],
                            'amount' => $data['ps']['amount']
                        );
                    }
                    if (!empty($data['cp']['id'])) {
                        $filteredData[$index]['package'] = array(
                            'name' => $data['cp']['duration'] . ' months custom package',
                            'duration' => $data['cp']['duration'],
                            'amount' => $data['cp']['charge']
                        );
                    }
                    $filteredData[$index]['comments'] = array();
                    if (!empty($data['c']['content'])) {
                        $temp = array('content' => $data['c'], 'user' => $data['u']);
                        $filteredData[$index]['comments'][] = $temp;
                    }
                    if (count($data['i'])) {
                        $filteredData[$index]['issue'] = $data['i']['name'];
                    }
                }
            }
            $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
            $clicked = true;
            $this->set(compact('filteredData', 'technician'));
        }
        $this->set(compact('clicked'));
    }

    function wire_problem() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on pc.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
where LOWER(i.name) = 'wire problem' and approved = 0");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
//  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);

                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                $filteredData[$index]['comments'] = array();

                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function troubleshot_technician() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on pc.user_id = u.id
left join users ut on pc.technician_id = ut.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
WHERE pc.status = 'old_ready'");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                $filteredData[$index]['package'] = array(
                    'name' => 'No package dealings',
                    'duration' => 'Not Applicable',
                    'amount' => 'not Applicable'
                );

                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (count($data['i'])) {
                    $filteredData[$index]['issue'] = $data['i']['name'];
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function moving() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on pc.user_id = u.id
left join users ut on pc.technician_id = ut.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
where LOWER(i.name) = 'moving' and approved = 0");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {
            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
//  $temp = $data['c'];// array('id' => $data['psettings']['id'], 'duration' => $data['psettings']['duration'], 'amount' => $data['psettings']['amount'], 'offer' => $data['psettings']['offer']);
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];
                $filteredData[$index]['tech'] = $data['ut'];

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                $filteredData[$index]['comments'] = array();

                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));
        $this->set(compact('filteredData', 'technician'));
    }

    function remote_problem() {
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        $allData = $this->PackageCustomer->query("SELECT * FROM package_customers pc 
left join comments c on pc.id = c.package_customer_id
left join users u on c.user_id = u.id
left join psettings ps on ps.id = pc.psetting_id
left join custom_packages cp on cp.id = pc.custom_package_id 
left join issues i on pc.issue_id = i.id
where LOWER(i.name) = 'remote problem' and approved = 0 and LOWER(pc.status)!= 'scheduled'");
        $filteredData = array();
        $unique = array();
        $index = 0;
        foreach ($allData as $key => $data) {

            $pd = $data['pc']['id'];
            if (isset($unique[$pd])) {
//  echo 'already exist'.$key.'<br/>';
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pd] = 'set';

                $filteredData[$index]['customers'] = $data['pc'];
                $filteredData[$index]['users'] = $data['u'];

                if (!empty($data['i']['id'])) {
                    $filteredData[$index]['issue'] = $data['i'];
                }

                $filteredData[$index]['comments'] = array();
                if (!empty($data['c']['content'])) {
                    $temp = array('content' => $data['c'], 'user' => $data['u']);
                    $filteredData[$index]['comments'][] = $temp;
                }
                if (!empty($data['ps']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['ps']['name'],
                        'duration' => $data['ps']['duration'],
                        'amount' => $data['ps']['amount']
                    );
                }
                if (!empty($data['cp']['id'])) {
                    $filteredData[$index]['package'] = array(
                        'name' => $data['cp']['duration'] . ' months custom package',
                        'duration' => $data['cp']['duration'],
                        'amount' => $data['cp']['charge']
                    );
                }
            }
        }
        $technician = $this->User->find('list', array('conditions' => array('User.role_id' => 9)));

        $this->set(compact('filteredData', 'technician'));
    }

//duplicate data manage start

    function delete($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('BackupPackageCustomer');
        $cusdata = $this->PackageCustomer->findById($id);
        $cusdata['BackupPackageCustomer'] = $cusdata['PackageCustomer'];

        $this->BackupPackageCustomer->save($cusdata);
        $this->PackageCustomer->delete($id);
        $msg = '<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> Customer deleted succeesfully and it is stored in trash </strong>
</div>';
        $this->Session->setFlash($msg);
        return $this->redirect(array('controller' => 'admins', 'action' => 'servicemanage'));
    }

    function manage_delete_data() {
        $this->loadModel('BackupPackageCustomer');
        $data = $this->BackupPackageCustomer->find('all');
        $this->set(compact('data'));
    }

    function restore($id) {
        $this->loadModel('BackupPackageCustomer');
        $this->loadModel('PackageCustomer');
        $customer = $this->BackupPackageCustomer->findById($id);
        $data['PackageCustomer'] = $customer['BackupPackageCustomer'];
        $this->PackageCustomer->save($data);
        $this->BackupPackageCustomer->delete($id);
        $this->redirect(array('controller' => 'admins', 'action' => 'servicemanage'));
    }

    function stbs_update($id = 0) {
        $this->loadModel('PackageCustomer');
//        $sql = "select id, mac from package_customers limit 10962,11781";
        if ($id) {
            $sql = "SELECT id, mac from package_customers WHERE id = $id";
        }
        $data = $this->PackageCustomer->query($sql);
        foreach ($data as $temp) {
            $this->PackageCustomer->create();
            $this->PackageCustomer->id = $temp['package_customers']['id'];
            $mac = json_decode($temp['package_customers']['mac']);
            $stbs = count($mac);
            $this->PackageCustomer->save('stbs', $stbs);
        }
        return $this->redirect($this->referer());
    }

    function knowledge() {
        
    }

    function searchByticketId($ticketId, $param) {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        //fb means forwarded_by
        //fd means forwarded department
        //fi means who will perform this task
        //sb means who will solved this task
        //usb means who will unresolved this task
        $tickets = $this->Ticket->query("SELECT * FROM tickets t
        LEFT JOIN tracks tr ON tr.ticket_id = t.id
        left JOIN issues i ON tr.issue_id = i.id
        left join users fb on tr.forwarded_by = fb.id
        left join users sb on tr.solved_by = sb.id
        left join users usb on tr.unsolved_by = usb.id
        left JOIN roles fd ON tr.role_id = fd.id
        left JOIN users fi ON tr.user_id = fi.id
        left join package_customers pc on tr.package_customer_id = pc.id
        WHERE t.id   = $ticketId");
        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                $temp = array('tr' => $ticket['tr'], 'sb' => $ticket['sb'], 'usb' => $ticket['usb'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'sb' => $ticket['sb'], 'usb' => $ticket['usb'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('roles', 'users'));
        return $data;
    }

}

?>