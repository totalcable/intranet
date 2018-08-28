<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
/**

 * */
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TicketsController extends AppController {

    var $layout = 'admin';

    public function beforeFilter() {
        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
            // echo 'here'; exit; //(array('action' => 'deshboard'));
        }
        parent::beforeFilter();
    }

    public function isAuthorized($user = null) {
        return true;
    }

    function updateCustomer($status, $cid) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('StatusHistory');
        $this->loadModel('MacHistory');

        $this->PackageCustomer->id = $cid;
//        pr($status.' '.$cid); exit;
        $this->PackageCustomer->saveField("status", $status);
        $sql = "select * from statushistories";

        // create status history
        $data4statusHistory = array();

        $data4statusHistory['StatusHistory'] = array(
            'package_customer_id' => $cid,
            'date' => date('m-d-Y'),
            'status' => $status
        );

        // create mac history
        $data4macHistory = array();
        $data4macHistory['MacHistory'] = array(
            'package_customer_id' => $cid,
            'installation_date' => date('m-d-Y'),
            'status' => $status
        );
//        pr($data4statusHistory); exit;
        $this->StatusHistory->save($data4statusHistory);
        $this->MacHistory->save($data4macHistory);
    }

    function addNewAddr($new_addr, $cid, $issue_id) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->id = $cid;
        $data['PackageCustomer'] = array(
            "issue_id" => $issue_id,
            "troubleshoot_moving_issue" => $issue_id,
            "approved" => 0,
            "status" => 'old_ready',
            "issue_date" => date("Y-m-d"),
            "new_addr" => $new_addr
        );
//        pr($data); exit;
        $this->PackageCustomer->save($data);
    }

    function create($customer_id = null) {
        if ($customer_id == null) {
            $this->redirect('/admins/servicemanage');
        }
        $loggedUser = $this->Auth->user();
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('Issue');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Issue');
        $this->loadModel('TicketDepartment');
        $this->loadModel('PackageCustomer');
        $this->loadModel('Mac');
        $this->loadModel('MacDetail');

        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        if ($this->request->is('post')) {

            $this->Ticket->set($this->request->data);
            if ($this->Ticket->validates()) {
                if (empty($this->request->data['Ticket']['user_id']) &&
                        empty($this->request->data['Ticket']['role_id']) &&
                        empty($this->request->data['Ticket']['action_type'])) {
                    $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this ticket  </strong>
			</div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->referer());
                }
                //pr($this->request->data); exit;
                if (trim($this->request->data['Ticket']['issue_id']) == 21 ||
                        trim($this->request->data['Ticket']['issue_id']) == 30 ||
                        trim($this->request->data['Ticket']['issue_id']) == 36 ||
                        trim($this->request->data['Ticket']['issue_id']) == 24 ||
                        trim($this->request->data['Ticket']['issue_id']) == 31 ||
                        trim($this->request->data['Ticket']['issue_id']) == 20 ||
                        trim($this->request->data['Ticket']['issue_id']) == 28 ||
                        trim($this->request->data['Ticket']['action_type']) == "ready" ||
                        trim($this->request->data['Ticket']['action_type']) == 'shipment') {
                    $this->PackageCustomer->id = $customer_id;
                    $data['PackageCustomer'] = array(
                        "deposit" => $this->request->data['Ticket']['deposit'],
                        "monthly_bill" => $this->request->data['Ticket']['monthly_bill'],
                        "others" => $this->request->data['Ticket']['others'],
                        "total" => $this->request->data['Ticket']['total'],
                        "remote_no" => $this->request->data['Ticket']['remote_no'],
                        "issue_id" => $this->request->data['Ticket']['issue_id'],
                        "comments" => $this->request->data['Ticket']['content'],
                        "status" => 'requested',
                        "user_id" => $loggedUser['id']
                    );
//                    pr($data); exit;
                    $cusinfo = $this->PackageCustomer->save($data);
                }

                $status = 'open';
                if (trim($this->request->data['Ticket']['action_type']) == 'solved' ||
                        trim($this->request->data['Ticket']['action_type']) == 'ready' ||
                        trim($this->request->data['Ticket']['action_type']) == 'shipment' ||
                        trim($this->request->data['Ticket']['issue_id']) == 17) {
                    $this->request->data['Ticket']['priority'] = 'low';
                    $this->request->data['Ticket']['status'] = 'solved';
                    $status = 'solved';
                }

                $tickect = $this->Ticket->save($this->request->data['Ticket']); // Data save in Ticket

                $trackData['Track'] = array(
                    'issue_id' => $this->request->data['Ticket']['issue_id'],
                    'package_customer_id' => $customer_id,
                    'user_id' => $this->request->data['Ticket']['user_id'],
                    'role_id' => $this->request->data['Ticket']['role_id'],
                    'issue_id' => $this->request->data['Ticket']['issue_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => $status,
                    'forwarded_by' => $loggedUser['id']
                );

//              moving.........
//              pr($this->request->data); exit;
                if (trim($this->request->data['Ticket']['issue_id']) == 17 || trim($this->request->data['Ticket']['issue_id']) == 154 || trim($this->request->data['Ticket']['issue_id']) == 192 || trim($this->request->data['Ticket']['issue_id']) == 229) {
                    $issue_id = $this->request->data['Ticket']['issue_id'];
                    $this->addNewAddr($this->request->data['Ticket']['new_addr'], $customer_id, $issue_id);
                    $trackData['Track']['status'] = 'close';
                }

                if (trim($this->request->data['Ticket']['issue_id']) == 21 || trim($this->request->data['Ticket']['issue_id']) == 30) {
                    // $this->updateCustomer('Request to hold', $customer_id);
                    // $trackData['Track']['status'] = 'others';
                    $mac = json_encode($this->request->data['mac']);
                    $data = array(
                        'cancel_mac' => $mac,
                        'hold_date' => $this->request->data['Ticket']['hold_date']
                    );
                    $cusinfo = $this->PackageCustomer->save($data);
                }

                if (trim($this->request->data['Ticket']['issue_id']) == 147 || trim($this->request->data['Ticket']['issue_id']) == 149 ||
                        trim($this->request->data['Ticket']['issue_id']) == 150 ||
                        trim($this->request->data['Ticket']['issue_id']) == 181) {
                    //$this->updateCustomer('Request to cancel', $customer_id);
                    // $trackData['Track']['status'] = 'others';
//                    $mac = json_encode($this->request->data['mac']);
                    $data = array(
                        'cancelled_date' => $this->request->data['Ticket']['cancelled_date'],
                        'issue_id' => $this->request->data['Ticket']['issue_id']
                    );
//                    pr($data); exit;
                    $cusinfo = $this->PackageCustomer->save($data);
                }


                if (trim($this->request->data['Ticket']['issue_id']) == 27 || trim($this->request->data['Ticket']['issue_id']) == 29) {
                    //$this->updateCustomer('Request to reconnection', $customer_id);
                    // $trackData['Track']['status'] = 'others';
//                    $mac = json_encode($this->request->data['mac']);
//                    pr($this->request->data['Ticket']); exit;
                    $data = array(
                        'reconnect_date' => $this->request->data['Ticket']['reconnect_date'],
                        'issue_id' => $this->request->data['Ticket']['issue_id'],
                        'comments' => $this->request->data['Ticket']['content']
                    );
//                    pr($data); exit;
                    $cusinfo = $this->PackageCustomer->save($data);
                }
//pr('hfh'); exit;
//                if (trim($this->request->data['Ticket']['issue_id']) == 36) {
//                    $this->updateCustomer('Request to reconnection', $customer_id);
//                    $trackData['Track']['status'] = 'others';
//                    $mac = json_encode($this->request->data['mac']);
//                    $data = array(
//                        'cancel_mac' => $mac,
//                        'reconnect_date' => $this->request->data['Ticket']['reconnect_date']
//                    );
//
//                    $cusinfo = $this->PackageCustomer->save($data);
//                }

                if (trim($this->request->data['Ticket']['issue_id']) == 24 || trim($this->request->data['Ticket']['issue_id']) == 31) {
                    //$this->updateCustomer('Request to unhold', $customer_id);
                    // $trackData['Track']['status'] = 'others';
                    $data = array(
                        'unhold_date' => $this->request->data['Ticket']['unhold_date']
                    );
                    if (isset($this->request->data['mac'])) {
                        $mac = json_encode($this->request->data['mac']);
                        $data['cancel_mac'] = $mac;
                    }
                    $cusinfo = $this->PackageCustomer->save($data);
                }

                if (trim($this->request->data['Ticket']['issue_id']) == 20 || trim($this->request->data['Ticket']['issue_id']) == 28 || trim($this->request->data['Ticket']['issue_id']) == 147 || trim($this->request->data['Ticket']['issue_id']) == 149 || trim($this->request->data['Ticket']['issue_id']) == 150 || trim($this->request->data['Ticket']['issue_id']) == 181) {

                    $this->request->data['Ticket']['cancelled_date'] = $this->getFormatedDate($this->request->data['Ticket']['cancelled_date']);
                    $this->request->data['Ticket']['pickup_date'] = $this->getFormatedDate($this->request->data['Ticket']['pickup_date']);

                    //$this->updateCustomer('request to cancel', $customer_id);
                    if (!array_key_exists('mac', $this->request->data)) {
                        $msg = '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> No mac was selected !</strong>
			</div>';
                        $this->Session->setFlash($msg);
                        return $this->redirect($this->referer());
                    }
                    $mac = json_encode($this->request->data['mac']);
                    $data = array(
                        'cancel_mac' => $mac,
                        'cancelled_date' => $this->request->data['Ticket']['cancelled_date'],
                        'pickup_date' => $this->request->data['Ticket']['pickup_date'],
                    );
//                    pr('here'); exit;
                    $cusinfo = $this->PackageCustomer->save($data);
                }

                if (trim($this->request->data['Ticket']['action_type']) == "ready") {
                    $data['PackageCustomer'] = array(
                        'status' => 'old_ready',
                        'issue_date' => date('Y-m-d'),
                        'troubleshoot_shipment' => 'tro',
                        'shipment_equipment' => $this->request->data['Ticket']['shipment_equipment'],
                        'troubleshoot_moving_issue' => $this->request->data['Ticket']['issue_id'],
                        'shipment_note' => $this->request->data['Ticket']['shipment_note']
                    );
                    $this->PackageCustomer->id = $customer_id;
                    //pr($data['PackageCustomer']); exit;

                    $this->PackageCustomer->save($data['PackageCustomer']);
                }

                if (trim($this->request->data['Ticket']['action_type']) == 'shipment') {
                    // pr($this->request->data); exit;
                    if ($this->request->data['Ticket']['shipment_equipment'] == 'OTHER') {
                        $this->request->data['Ticket']['shipment_equipment'] = $this->request->data['Ticket']['shipment_equipment_other'];
                    }
                    $data['PackageCustomer'] = array(
                        'id' => $customer_id,
                        'shipment' => 2,
                        'approved' => 0,
                        'issue_date' => date('Y-m-d'),
                        'troubleshoot_shipment' => 'shi',
                        'shipment_equipment' => $this->request->data['Ticket']['shipment_equipment'],
                        'troubleshoot_moving_issue' => $this->request->data['Ticket']['issue_id'],
                        'shipment_note' => $this->request->data['Ticket']['shipment_note']
                    );
                    $this->PackageCustomer->save($data['PackageCustomer']);
                }

                //  This code for outbound

                if (trim($this->request->data['Ticket']['issue_id']) == 171) {
                    $this->PackageCustomer->id = $customer_id;
                    $trackData['Track']['status'] = 'outbound';
                    $data['PackageCustomer'] = array(
                        "outbound" => $this->request->data['Ticket']['outbound'],
                        "issue_id" => $this->request->data['Ticket']['issue_id'],
                        "comments" => $this->request->data['Ticket']['content'],
                        "status" => 'requested',
                        "user_id" => $loggedUser['id']
                    );
                    $cusinfo = $this->PackageCustomer->save($data);
                }

                $customer = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $customer_id)));

//                if (!empty($customer['PackageCustomer']['email'])) {
//                    // send mail :
//                    $from = 'info@totalcableusa.com';
//                    $subject = "Ticket create";
//                    $to = array($customer['PackageCustomer']['email']);
//                    $cus_name = $customer['PackageCustomer']['first_name'] . ' ' . $customer['PackageCustomer']['middle_name'] . ' ' . $customer['PackageCustomer']['last_name'];
//                    $address = $customer['PackageCustomer']['house_no'];
//
//                    $mail_content = __('Name:                      ', 'beopen') . $cus_name . PHP_EOL .
//                            __('Address:                   ', 'beopen') . $address . PHP_EOL;
//
//                    if (!empty($refer_name)):
//                        $mail_content .= __('Reference Name:            ', 'beopen') . $refer_name . PHP_EOL .
//                                __('Reference Phone:           ', 'beopen') . $refer_no . PHP_EOL;
//                    endif;
//
//                    $mail_content .= __('Sale status:               ', 'beopen') . $cus_name . PHP_EOL .
//                            __('Note:                      ', 'beopen') . $address . PHP_EOL;
//
//                    sendEmail($from, $cus_name, $to, $subject, $mail_content);
//                    // End send mail 
//                }
//
//                 pr('last'); exit;
                $this->Track->save($trackData); // Data save in Track
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Ticket created succeesfully </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Ticket->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
//        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $customers = $this->PackageCustomer->findById($customer_id);

        $this->set(compact('users', 'roles', 'issues', 'customers'));
    }

    function edit_ticket($id = null, $customer_id = 0) {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('Issue');
        $this->loadModel('User');
        $this->loadModel('Role');
        $this->loadModel('Issue');
        $this->loadModel('TicketDepartment');
        $this->loadModel('PackageCustomer');
        $ticket_info = $this->Ticket->query("SELECT * FROM tickets LEFT JOIN tracks on tickets.id = tracks.ticket_id where tickets.id = $id");
        $track_id = $ticket_info[0]['tracks']['id'];
        unset($ticket_info[0]['tracks']['id']);
        $data = $ticket_info[0]['tracks'] + $ticket_info[0]['tickets'];
        $this->request->data['Ticket'] = $data;
        if ($this->request->is('post') || $this->request->is('put')) {

            if (empty($this->request->data['Ticket']['user_id']) &&
                    empty($this->request->data['Ticket']['role_id']) &&
                    empty($this->request->data['Ticket']['action_type'])) {
                $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this ticket  </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            }

            if (trim($this->request->data['Ticket']['issue_id']) == 21 ||
                    trim($this->request->data['Ticket']['issue_id']) == 30 ||
                    trim($this->request->data['Ticket']['issue_id']) == 36 ||
                    trim($this->request->data['Ticket']['issue_id']) == 24 ||
                    trim($this->request->data['Ticket']['issue_id']) == 31 ||
                    trim($this->request->data['Ticket']['issue_id']) == 20 ||
                    trim($this->request->data['Ticket']['issue_id']) == 28 ||
                    trim($this->request->data['Ticket']['action_type']) == "ready" ||
                    trim($this->request->data['Ticket']['action_type']) == 'shipment') {
                $this->PackageCustomer->id = $customer_id;
                $data['PackageCustomer'] = array(
                    "deposit" => $this->request->data['Ticket']['deposit'],
                    "monthly_bill" => $this->request->data['Ticket']['monthly_bill'],
                    "others" => $this->request->data['Ticket']['others'],
                    "total" => $this->request->data['Ticket']['total'],
                    "remote_no" => $this->request->data['Ticket']['remote_no'],
                    "issue_id" => $this->request->data['Ticket']['issue_id'],
                    "comments" => $this->request->data['Ticket']['content'],
                    "status" => 'requested',
                    "user_id" => $loggedUser['id']
                );
                $cusinfo = $this->PackageCustomer->save($data);
            }


            $status = 'open';
            if (trim($this->request->data['Ticket']['action_type']) == 'solved' ||
                    trim($this->request->data['Ticket']['action_type']) == 'ready' ||
                    trim($this->request->data['Ticket']['action_type']) == 'shipment') {
                $this->request->data['Ticket']['priority'] = 'low';
                $this->request->data['Ticket']['status'] = 'solved';
                $status = 'solved';
            }
//            pr($this->request->data); exit;
            $this->Ticket->id = $id;
            $this->Ticket->save($this->request->data['Ticket']); // Data save in Ticket
            $trackData['Track'] = array(
                'issue_id' => $this->request->data['Ticket']['issue_id'],
                'package_customer_id' => $customer_id,
                'user_id' => $this->request->data['Ticket']['user_id'],
                'role_id' => $this->request->data['Ticket']['role_id'],
                'issue_id' => $this->request->data['Ticket']['issue_id'],
                'ticket_id' => $id,
                'status' => $status,
                'forwarded_by' => $loggedUser['id']
            );

            if (trim($this->request->data['Ticket']['action_type']) == 'solved') {
                $trackData['Track']['status'] = 'solved';
            }

            if (trim($this->request->data['Ticket']['issue_id']) == 17) {
                $this->addNewAddr($this->request->data['Ticket']['new_addr'], $customer_id);
                $trackData['Track']['status'] = 'others';
            }
            if (trim($this->request->data['Ticket']['issue_id']) == 21 || trim($this->request->data['Ticket']['issue_id']) == 30) {
                $this->updateCustomer('Request to hold', $customer_id);
                // $trackData['Track']['status'] = 'others';
                $mac = json_encode($this->request->data['mac']);
//                pr($this->request->data['Ticket']); exit;
                $data = array(
                    'cancel_mac' => $mac,
                    'hold_date' => $this->request->data['Ticket']['hold_date'],
                    'issue_id' => $this->request->data['Ticket']['issue_id'],
                    'hold_date' => $this->request->data['Ticket']['hold_date']
                );
//                pr($data); exit;

                $cusinfo = $this->PackageCustomer->save($data);
            }

            if (trim($this->request->data['Ticket']['issue_id']) == 36) {
                $this->updateCustomer('Request to reconnection', $customer_id);
                $trackData['Track']['status'] = 'others';
                $mac = json_encode($this->request->data['mac']);
                $data = array(
                    'cancel_mac' => $mac,
                    'reconnect_date' => $this->request->data['Ticket']['reconnect_date']
                );

                $cusinfo = $this->PackageCustomer->save($data);
            }

            if (trim($this->request->data['Ticket']['issue_id']) == 24 || trim($this->request->data['Ticket']['issue_id']) == 31) {
                $this->updateCustomer('Request to unhold', $customer_id);
                // $trackData['Track']['status'] = 'others';
                $data = array(
                    'unhold_date' => $this->request->data['Ticket']['unhold_date'],
                    'issue_id' => $this->request->data['Ticket']['issue_id']
                );
                if (isset($this->request->data['mac'])) {
                    $mac = json_encode($this->request->data['mac']);
                    $data['cancel_mac'] = $mac;
                }
//                pr($data); exit;

                $cusinfo = $this->PackageCustomer->save($data);
            }

            if (trim($this->request->data['Ticket']['issue_id']) == 20 || trim($this->request->data['Ticket']['issue_id']) == 28) {

//                $this->request->data['Ticket']['cancelled_date'] = $this->getFormatedDate($this->request->data['Ticket']['cancelled_date']);
//                $this->request->data['Ticket']['pickup_date'] = $this->getFormatedDate($this->request->data['Ticket']['pickup_date']);

                $this->updateCustomer('Request to cancel', $customer_id);
                if (!array_key_exists('mac', $this->request->data)) {
                    $msg = '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> No mac was selected !</strong>
			</div>';
                    $this->Session->setFlash($msg);
                    return $this->redirect($this->referer());
                }
                $mac = json_encode($this->request->data['mac']);
                $data = array(
                    'cancel_mac' => $mac,
                    'cancelled_date' => $this->request->data['Ticket']['cancelled_date'],
                    'issue_id' => $this->request->data['Ticket']['issue_id'],
                    'pickup_date' => $this->request->data['Ticket']['pickup_date'],
                );

                $cusinfo = $this->PackageCustomer->save($data);
            }

            if (trim($this->request->data['Ticket']['action_type']) == "ready") {
                $data['PackageCustomer'] = array(
                    'status' => 'old_ready',
                    'shipment_equipment' => $this->request->data['Ticket']['shipment_equipment'],
                    'shipment_note' => $this->request->data['Ticket']['shipment_note']
                );
                $this->PackageCustomer->id = $customer_id;
                $this->PackageCustomer->save($data['PackageCustomer']);
            }
            if (trim($this->request->data['Ticket']['action_type']) == 'shipment') {

                if ($this->request->data['Ticket']['shipment_equipment'] == 'OTHER') {
                    $this->request->data['Ticket']['shipment_equipment'] = $this->request->data['Ticket']['shipment_equipment_other'];
                }
                $data['PackageCustomer'] = array(
                    'id' => $customer_id,
                    'shipment' => 2,
                    'approved' => 0,
                    'shipment_equipment' => $this->request->data['Ticket']['shipment_equipment'],
                    'shipment_note' => $this->request->data['Ticket']['shipment_note']
                );
                $this->PackageCustomer->save($data['PackageCustomer']);
            }
            $customer = $this->PackageCustomer->find('first', array('conditions' => array('PackageCustomer.id' => $customer_id)));

//                if (!empty($customer['PackageCustomer']['email'])) {
//                    // send mail :
//                    $from = 'info@totalcableusa.com';
//                    $subject = "Ticket create";
//                    $to = array($customer['PackageCustomer']['email']);
//                    $cus_name = $customer['PackageCustomer']['first_name'] . ' ' . $customer['PackageCustomer']['middle_name'] . ' ' . $customer['PackageCustomer']['last_name'];
//                    $address = $customer['PackageCustomer']['house_no'];
//
//                    $mail_content = __('Name:                      ', 'beopen') . $cus_name . PHP_EOL .
//                            __('Address:                   ', 'beopen') . $address . PHP_EOL;
//
//                    if (!empty($refer_name)):
//                        $mail_content .= __('Reference Name:            ', 'beopen') . $refer_name . PHP_EOL .
//                                __('Reference Phone:           ', 'beopen') . $refer_no . PHP_EOL;
//                    endif;
//
//                    $mail_content .= __('Sale status:               ', 'beopen') . $cus_name . PHP_EOL .
//                            __('Note:                      ', 'beopen') . $address . PHP_EOL;
//
//                    sendEmail($from, $cus_name, $to, $subject, $mail_content);
//                    // End send mail 
//                }
//
            $this->Track->id = $track_id;
            pr('here');
            exit;
            $this->Track->save($trackData); // Data save in Track
            $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Ticket created succeesfully </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        $issues = $this->Issue->find('list', array('fields' => array('id', 'name',), 'order' => array('Issue.name' => 'ASC')));
        $customers = $this->PackageCustomer->findById($customer_id);

        $this->set(compact('users', 'roles', 'issues', 'customers'));
    }

    function close($id = null) {
        $this->loadModel('Track');
        $this->Ticket->id = $id;
        $this->Ticket->saveField("status", "closed");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Ticket is closed succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function unsolve() {
        $this->loadModel('Track');
        unset($this->request->data['Track']['id']);
        $this->request->data['Track']['status'] = 'unresolved';
        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];

        $this->Track->save($this->request->data['Track']);
        $this->Ticket->id = $this->request->data['Track']['ticket_id'];
        $this->Ticket->saveField('status', 'unresolved');

        $msg = '<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Ticket is closed without solution </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function ticket_comment() {
        $this->loadModel('Track');
        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];
        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
        $this->Track->save($this->request->data['Track']);
        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Comments insert succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function solve() {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        //$this->Track->set($this->request->data);
        //$this->Track->id = $this->request->data['Track']['id'];
        unset($this->request->data['Track']['id']);
        $this->request->data['Track']['status'] = 'solved';

        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];

        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];

        $this->Track->save($this->request->data['Track']);
        $this->Ticket->id = $this->request->data['Track']['ticket_id'];

        $data = $this->Ticket->saveField('status', 'solved');
        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Ticket is Solved succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function edit() {
        $this->loadModel('Role');
        if ($this->request->is('post')) {
            $this->Role->set($this->request->data);
            if ($this->Role->validates()) {
                $this->Role->id = $this->request->data['Role']['id'];
                $this->Role->save($this->request->data['Role']);
                $msg = '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Role edited succeesfully </strong>
                </div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Role->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        $roles = $this->Role->find('list', array('order' => array('Role.name' => 'ASC')));
        $this->set(compact('roles'));
    }

    function manage($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;
        $loggedUser = $this->Auth->user();
        if ($loggedUser['Role']['name'] == 'sadmin') {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
			left join package_customers pc on tr.package_customer_id = pc.id where tr.status != 'solved' and tr.status != 'closed' order by tr.created DESC" . " LIMIT " . $offset . "," . $this->per_page);
        } else {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE tr.user_id =" . $loggedUser['id'] . " AND tr.status != 'solved' ORDER BY tr.created DESC" . " LIMIT " . $offset . "," . $this->per_page);
        }

        $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets`");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));

        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function assigned_to_me($page = 1) {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $loggedUser = $this->Auth->user();
        $u_id = $loggedUser['id'];
        $offset = --$page * $this->per_page;
        $sql = "SELECT * from tracks tr 
        LEFT JOIN tickets t ON tr.ticket_id = t.id 
        left JOIN issues i ON tr.issue_id = i.id 
        left join users fb on tr.forwarded_by = fb.id 
        left join users sb on tr.solved_by = sb.id 
        left join users usb on tr.unsolved_by = usb.id 
        left JOIN roles fd ON tr.role_id = fd.id 
        left JOIN users fi ON tr.user_id = fi.id 
        left join package_customers pc on tr.package_customer_id = pc.id 
        where tr.user_id = $u_id";
        $tickets = $this->Ticket->query("SELECT * from tracks tr 
        LEFT JOIN tickets t ON tr.ticket_id = t.id 
        left JOIN issues i ON tr.issue_id = i.id 
        left join users fb on tr.forwarded_by = fb.id 
        left join users sb on tr.solved_by = sb.id 
        left join users usb on tr.unsolved_by = usb.id 
        left JOIN roles fd ON tr.role_id = fd.id 
        left JOIN users fi ON tr.user_id = fi.id 
        left join package_customers pc on tr.package_customer_id = pc.id 
        where tr.user_id = " .
                $loggedUser['id'] . " ORDER BY tr.id DESC" . " LIMIT " . $offset . "," . $this->per_page);
//        echo $this->Ticket->getLastQuery(); exit;
        $temp = $this->Ticket->query("SELECT COUNT( DISTINCT tr.ticket_id ) AS total FROM tracks tr WHERE tr.user_id = " . $loggedUser['id']);

        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

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
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function forwarded_by($page = 1) {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;
        $loggedUser = $this->Auth->user();
        $tickets = $this->Ticket->query("SELECT * from tracks tr 
        LEFT JOIN tickets t ON tr.ticket_id = t.id 
        left JOIN issues i ON tr.issue_id = i.id 
        left join users fb on tr.forwarded_by = fb.id 
        left join users sb on tr.solved_by = sb.id 
        left join users usb on tr.unsolved_by = usb.id 
        left JOIN roles fd ON tr.role_id = fd.id 
        left JOIN users fi ON tr.user_id = fi.id 
        left join package_customers pc on tr.package_customer_id = pc.id 
        where tr.forwarded_by = " .
                $loggedUser['id'] . " ORDER BY tr.id DESC" . " LIMIT " . $offset . "," . $this->per_page);

        $temp = $this->Ticket->query("SELECT COUNT( DISTINCT tr.ticket_id ) AS total FROM tracks tr WHERE tr.forwarded_by = " . $loggedUser['id']);
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

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
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function customertickethistory($id = null) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
//        $tickets = $this->Track->query("SELECT * FROM tracks tr 
//                    inner join tickets t on tr.ticket_id = t.id
//                    inner join users fb on tr.forwarded_by = fb.id
//                    inner join roles r on  tr.role_id = r.id
//                    inner join users ft on  tr.user_id = ft.id order by tr.created desc");
        $loggedUser = $this->Auth->user();
        if ($loggedUser['Role']['name'] == 'sadmin') {
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
			left join package_customers pc on tr.package_customer_id = pc.id where pc.id = $id order by tr.created DESC");
        } else {

            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id where pc.id = $id
                        and tr.role_id =" . $loggedUser['Role']['id'] . " OR tr.user_id =" . $loggedUser['Role']['id'] . " ORDER BY tr.created DESC");
        }

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles'));
    }

    function forward() {
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
        if (empty($this->request->data['Track']['user_id']) && empty($this->request->data['Track']['role_id'])) {
            $msg = '<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> You must select: Who or Which department is responsible for this ticket  </strong>
			</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $t_id = $this->request->data['Track']['ticket_id'];
        $tickets = $this->Track->query("SELECT * FROM `tracks` WHERE `ticket_id` = $t_id");

        $this->request->data['Track']['issue_id'] = $tickets[0]['tracks']['issue_id'];
        $this->request->data['Track']['package_customer_id'] = $tickets[0]['tracks']['package_customer_id'];

        $this->Track->save($this->request->data['Track']);
        $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> Ticket Forwarded successfully!  </strong>
			</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function addmassage() {
        $this->loadModel('Message');
        if ($this->request->is('post')) {
            $this->Message->set($this->request->data);
            if ($this->Message->validates()) {
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
    }

    function in_progress($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;
        $tickets = $this->Track->query("SELECT * FROM tracks tr 
                    LEFT JOIN tickets t ON tr.ticket_id = t.id 
                    LEFT JOIN users fb ON tr.forwarded_by = fb.id 
                    LEFT JOIN roles fd ON tr.role_id = fd.id 
                    LEFT JOIN users fi ON tr.user_id = fi.id 
                    LEFT JOIN issues i ON tr.issue_id = i.id 
                    LEFT join package_customers pc on tr.package_customer_id = pc.id 
                    Where (t.status = 'open' AND tr.status != 'outbound'  AND tr.issue_id !=181 AND tr.issue_id !=150 AND tr.issue_id !=167 AND tr.issue_id !=149 AND tr.issue_id !=147 AND tr.issue_id !=28 AND tr.issue_id !=31 AND tr.issue_id !=30 AND tr.issue_id !=29 AND tr.issue_id !=89 AND tr.issue_id !=229 AND tr.issue_id !=154) AND  (t.content NOT LIKE '%be expired%' AND t.content NOT LIKE '%Error Code%' AND t.content NOT LIKE '%successful%'
                    AND t.content NOT LIKE '%declined%' AND t.content NOT LIKE '%leatest card information%')ORDER BY tr.created " . " LIMIT " . $offset . "," . $this->per_page);
//        echo $this->Track->getLastQuery(); exit;
        $temp = $this->Track->query("SELECT COUNT(tr.id) as total FROM tracks tr 
                LEFT JOIN tickets t ON tr.ticket_id = t.id 
                LEFT JOIN users fb ON tr.forwarded_by = fb.id 
                LEFT JOIN roles fd ON tr.role_id = fd.id 
                LEFT JOIN users fi ON tr.user_id = fi.id 
                LEFT JOIN issues i ON tr.issue_id = i.id 
                LEFT join package_customers pc on tr.package_customer_id = pc.id 
                Where (t.status = 'open' AND tr.status != 'outbound'  AND tr.issue_id !=181 AND tr.issue_id !=150 AND tr.issue_id !=167 AND tr.issue_id !=149 AND tr.issue_id !=147 AND tr.issue_id !=28 AND tr.issue_id !=31 AND tr.issue_id !=30 AND tr.issue_id !=29 AND tr.issue_id !=89 AND tr.issue_id !=229 AND tr.issue_id !=154) AND  (t.content NOT LIKE '%be expired%' AND t.content NOT LIKE '%Error Code%' AND t.content NOT LIKE '%successful%'
                AND t.content NOT LIKE '%declined%' AND t.content NOT LIKE '%leatest card information%')");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];

            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }

        $data = $filteredTicket;
//        pr($data); exit;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles', 'total', 'total_page'));
    }

    function promise_pay($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;
        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        INNER JOIN tickets t ON tr.ticket_id = t.id
                        INNER JOIN users fb ON tr.forwarded_by = fb.id
                        INNER JOIN roles fd ON tr.role_id = fd.id
                        INNER JOIN users fi ON tr.user_id = fi.id
                        INNER JOIN issues i ON tr.issue_id = i.id
                        INNER join package_customers pc on tr.package_customer_id = pc.id
                        WHERE tr.`issue_id` = '204' and tr.`status` = 'open' ORDER BY tr.created DESC  " . " LIMIT " . $offset . "," . $this->per_page);
        echo $this->Track->getLastQuery();
        pr($tickets);
        exit;

        $temp = $this->Ticket->query("SELECT COUNT(tr.id) as total FROM tracks tr
                        INNER JOIN tickets t ON tr.ticket_id = t.id
                        INNER JOIN users fb ON tr.forwarded_by = fb.id
                        INNER JOIN roles fd ON tr.role_id = fd.id
                        INNER JOIN users fi ON tr.user_id = fi.id
                        INNER JOIN issues i ON tr.issue_id = i.id
                        INNER join package_customers pc on tr.package_customer_id = pc.id
                        WHERE tr.`issue_id` = '204' and tr.`status` = 'open'");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        //  pr($roles); exit;
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function refund_bonus() {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $tickets = $this->Track->query("SELECT * FROM tracks tr 
                LEFT JOIN tickets t ON tr.ticket_id = t.id 
                LEFT JOIN users fb ON tr.forwarded_by = fb.id 
                LEFT JOIN roles fd ON tr.role_id = fd.id 
                LEFT JOIN users fi ON tr.user_id = fi.id 
                LEFT JOIN issues i ON tr.issue_id = i.id 
                LEFT join package_customers pc on tr.package_customer_id = pc.id 
                Where (t.status = 'open' AND tr.status != 'outbound')AND (tr.issue_id=22 OR tr.issue_id=172 OR tr.issue_id=23)");

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles'));
    }

    function pac_service() {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $tickets = $this->Track->query("SELECT * FROM tracks tr 
                LEFT JOIN tickets t ON tr.ticket_id = t.id 
                LEFT JOIN users fb ON tr.forwarded_by = fb.id 
                LEFT JOIN roles fd ON tr.role_id = fd.id 
                LEFT JOIN users fi ON tr.user_id = fi.id 
                LEFT JOIN issues i ON tr.issue_id = i.id 
                LEFT join package_customers pc on tr.package_customer_id = pc.id 
                Where (t.status = 'open' AND tr.status != 'outbound')AND (tr.issue_id=181 OR tr.issue_id=150 OR tr.issue_id=167 OR tr.issue_id=149 OR tr.issue_id=147 OR tr.issue_id=28 OR tr.issue_id=20 OR tr.issue_id=31 OR tr.issue_id=30 OR tr.issue_id=24 OR tr.issue_id=21 OR tr.issue_id=27 OR tr.issue_id=29 OR tr.issue_id=89)");

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles'));
    }

    function solved_ticket($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;

        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];


        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.status = 'solved' ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);

        $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets` WHERE tickets.status = 'solved'");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function verification($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;

        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];


        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.status = 'solved' AND t.verification_date = '0000-00-00'  ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);
        $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets` WHERE tickets.status = 'solved' AND tickets.verification_date = '0000-00-00'");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        //$rf= end($filteredTicket[$index]['history']);
        //pr($rf); exit;
        $data = $filteredTicket;

        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function ticket_verify() {
        $this->loadModel('Ticket');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $this->Ticket->set($this->request->data);
        $this->request->data['Ticket']['pc_info'] = $pc_info;
        $this->request->data['Ticket']['verification_solve'] = $this->request->data['Ticket']['verification_solve'];
        $this->request->data['Ticket']['verification_date'] = date("Y-m-d");
        $this->request->data['Ticket']['id'] = $this->request->data['Ticket']['id'];
       // pr($this->request->data['Ticket']); exit;
        $this->Ticket->save($this->request->data['Ticket']);
        $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Verification completed:-) </strong>
		</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function open_ticket() {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];

        //take tracks id start
        $t_id = $this->request->data['Track']['ticket_id'];
        $sql = "SELECT * FROM `tracks` WHERE `ticket_id` = $t_id ORDER BY id DESC LIMIT 0,1";
        $track = $this->Track->query($sql);
        $id = $track[0]['tracks']['id'];
        //take tracks id end
       
        $this->Track->id = $id;
        $this->request->data['Track']['status'] = 'open';
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
        $this->request->data['Track']['user_id'] = $this->request->data['Track']['user_id'];
//         pr($this->request->data); 
//        exit;
        $this->Track->save($this->request->data['Track']);

        $this->Ticket->id = $this->request->data['Track']['ticket_id'];
        $this->request->data['Ticket']['verification_date'] = date("Y-m-d");
        $this->request->data['Ticket']['status'] = 'open';

        $this->request->data['Ticket']['pc_info'] = $pc_info;
        $this->request->data['Ticket']['verification_not_solve'] = $this->request->data['Track']['verification_not_solve'];
        $data = $this->Ticket->save($this->request->data['Ticket']);
        $msg = '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Ticket is Open succeesfully </strong>
        </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function oldticket_open($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $offset = --$page * $this->per_page;
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data['Ticket']['daterange'])) {
                $datrange = json_decode($this->request->data['Ticket']['daterange'], true);
                $ds = new DateTime($datrange['start']);
                $timestamp = $ds->getTimestamp(); // Unix timestamp
                $startd = $ds->format('m/y'); // 2003-10-16
                $de = new DateTime($datrange['end']);
                $timestamp = $de->getTimestamp(); // Unix timestamp
                $endd = $de->format('m/y'); // 2003-10-16
                $conditions = "";
                if (count($datrange)) {
                    if ($datrange['start'] == $datrange['end']) {
                        $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                        //  convert(varchar(10),pc.schedule_date, 120) = '2014-02-07'
                        //CAST(pc.schedule_date as DATE)
                        $conditions .="t.verification_date >=' " . $datrange['start'] . "' AND t.verification_date < '" . $nextday . "'";
                    } else {
                        $conditions .="t.verification_date >='" . $datrange['start'] . "' AND  t.verification_date <='" . $datrange['end'] . "'";
                    }
                }
            } else {
                $conditions = "";
                $p_date = '2015-01-01';
                $conditions .="t.verification_date >='" . $p_date . "'";
            }
           // pr($conditions); exit;
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.verification_not_solve != '' AND $conditions ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);


            $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets` WHERE tickets.verification_not_solve != ''");
            $total = $temp[0][0]['total'];
            $total_page = ceil($total / $this->per_page);

            $filteredTicket = array();
            $unique = array();
            $index = 0;
            foreach ($tickets as $key => $ticket) {
                $t = $ticket['t']['id'];
                if (isset($unique[$t])) {
                    //  echo 'already exist'.$key.'<br/>';
                    $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                    $filteredTicket[$index]['history'][] = $temp;
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$t] = 'set';
                    $filteredTicket[$index]['ticket'] = $ticket['t'];
                    $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                    $filteredTicket[$index]['history'][] = $temp;
                }
            }

            $clicked = true;
            $data = $filteredTicket;           
            $this->set(compact('data', 'total_page', 'total'));
        }
        $this->set(compact('clicked'));
    }
    
    function verified($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $offset = --$page * $this->per_page;
        $clicked = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data['Ticket']['daterange'])) {
                $datrange = json_decode($this->request->data['Ticket']['daterange'], true);
                $ds = new DateTime($datrange['start']);
                $timestamp = $ds->getTimestamp(); // Unix timestamp
                $startd = $ds->format('m/y'); // 2003-10-16
                $de = new DateTime($datrange['end']);
                $timestamp = $de->getTimestamp(); // Unix timestamp
                $endd = $de->format('m/y'); // 2003-10-16
                $conditions = "";
                if (count($datrange)) {
                    if ($datrange['start'] == $datrange['end']) {
                        $nextday = date('Y-m-d', strtotime($datrange['end'] . "+1 days"));
                        //  convert(varchar(10),pc.schedule_date, 120) = '2014-02-07'
                        //CAST(pc.schedule_date as DATE)
                        $conditions .="t.verification_date >=' " . $datrange['start'] . "' AND t.verification_date < '" . $nextday . "'";
                    } else {
                        $conditions .="t.verification_date >='" . $datrange['start'] . "' AND  t.verification_date <='" . $datrange['end'] . "'";
                    }
                }
            } else {
                $conditions = "";
                $p_date = '2015-01-01';
                $conditions .="t.verification_date >='" . $p_date . "'";
            }
           // pr($conditions); exit;
            $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.verification_solve != '' AND $conditions ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);


            $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets` WHERE tickets.verification_solve != ''");
            $total = $temp[0][0]['total'];
            $total_page = ceil($total / $this->per_page);

            $filteredTicket = array();
            $unique = array();
            $index = 0;
            foreach ($tickets as $key => $ticket) {
                $t = $ticket['t']['id'];
                if (isset($unique[$t])) {
                    //  echo 'already exist'.$key.'<br/>';
                    $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                    $filteredTicket[$index]['history'][] = $temp;
                } else {
                    if ($key != 0)
                        $index++;
                    $unique[$t] = 'set';
                    $filteredTicket[$index]['ticket'] = $ticket['t'];
                    $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                    $filteredTicket[$index]['history'][] = $temp;
                }
            }

            $clicked = true;
            $data = $filteredTicket;           
            $this->set(compact('data', 'total_page', 'total'));
        }
        $this->set(compact('clicked'));
    }

    function verified_back($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;

        $loggedUser = $this->Auth->user();
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d h:i:sa");
        $pc_info = $myIp . ' ' . $pc . ' ' . $date . ' ' . $loggedUser['name'];
        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.verification_info != '' AND t.verification_date != '' ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);

        $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets` WHERE tickets.verification_info != ''");
        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        foreach ($tickets as $key => $ticket) {
            $t = $ticket['t']['id'];
            if (isset($unique[$t])) {
                //  echo 'already exist'.$key.'<br/>';
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            } else {
                if ($key != 0)
                    $index++;
                $unique[$t] = 'set';
                $filteredTicket[$index]['ticket'] = $ticket['t'];
                $temp = array('tr' => $ticket['tr'], 'fb' => $ticket['fb'], 'fd' => $ticket['fd'], 'fi' => $ticket['fi'], 'i' => $ticket['i'], 'pc' => $ticket['pc']);
                $filteredTicket[$index]['history'][] = $temp;
            }
        }
        $data = $filteredTicket;
        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function successful($page = 1) {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;
        $loggedUser = $this->Auth->user();
        $tickets = $this->Ticket->query("SELECT * from tracks tr 
        LEFT JOIN tickets t ON tr.ticket_id = t.id 
        left JOIN issues i ON tr.issue_id = i.id 
        left join users fb on tr.forwarded_by = fb.id 
        left join users sb on tr.solved_by = sb.id 
        left join users usb on tr.unsolved_by = usb.id 
        left JOIN roles fd ON tr.role_id = fd.id 
        left JOIN users fi ON tr.user_id = fi.id 
        left join package_customers pc on tr.package_customer_id = pc.id 
        where tr.issue_id = 0 AND  t.status = 'open' AND  t.content LIKE '%successfull%' ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);

        $temp = $this->Ticket->query("SELECT COUNT( DISTINCT tr.ticket_id ) AS total FROM tracks tr LEFT JOIN tickets t ON tr.ticket_id = t.id 
        where tr.issue_id = 0 AND  t.status = 'open' AND t.content LIKE '%successfull%'");

        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

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
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function decline_ticket($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;
        $loggedUser = $this->Auth->user();
        $tickets = $this->Track->query("SELECT * from tracks tr 
        LEFT JOIN tickets t ON tr.ticket_id = t.id 
        left JOIN issues i ON tr.issue_id = i.id 
        left join users fb on tr.forwarded_by = fb.id 
        left join users sb on tr.solved_by = sb.id 
        left join users usb on tr.unsolved_by = usb.id 
        left JOIN roles fd ON tr.role_id = fd.id 
        left JOIN users fi ON tr.user_id = fi.id 
        left join package_customers pc on tr.package_customer_id = pc.id 
        
        where tr.issue_id = 0 AND t.status ='open' AND t.content NOT LIKE ('%successful%')
        ORDER BY t.id DESC" . " LIMIT " . $offset . "," . $this->per_page);

        $temp = $this->Track->query("SELECT COUNT( tr.ticket_id ) AS total FROM tracks tr LEFT JOIN tickets t ON tr.ticket_id = t.id 
        where tr.issue_id = 0 AND t.status ='open' AND t.content NOT LIKE ('%successful%')");

        $total = $temp[0][0]['total'];
        $total_page = ceil($total / $this->per_page);

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
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function payment_success() {
        $this->loadModel('User');
        $this->loadModel('Ticket');
        $this->loadModel('PackageCustomer');
        $allData = $this->Ticket->query("SELECT * 
        FROM tickets AS ti
        LEFT JOIN tracks tr ON ti.id = tr.ticket_id
        LEFT JOIN package_customers pc ON tr.package_Customer_id = pc.id
        WHERE ti.payment_process =2");
        $this->set(compact('allData'));
    }

    function payment_failed() {
        $this->loadModel('User');
        $this->loadModel('Ticket');
        $this->loadModel('PackageCustomer');
        $allData = $this->Ticket->query("SELECT * FROM tickets AS ti
        LEFT JOIN tracks tr ON ti.id = tr.ticket_id
        LEFT JOIN package_customers pc ON tr.package_Customer_id = pc.id WHERE ti.payment_process =3");
        $this->set(compact('allData'));
    }

}

?>