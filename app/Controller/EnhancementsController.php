<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
/**
 * 
 */
App::uses('AppController', 'Controller');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class EnhancementsController extends AppController {

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


    function create() {
        $loggedUser = $this->Auth->user();
        if ($this->request->is('post')) {
            $this->Ticket->set($this->request->data);
            if ($this->Ticket->validates()) {
                $status = 'open';
                $tickect = $this->Ticket->save($this->request->data['Ticket']); // Data save in Ticket

                $this->Track->save($trackData); // Data save in Track
                $msg = '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong> New Enhancement request submitted succeesfully!. The weighted value of this requirement is under review. </strong>
			</div>';
                $this->Session->setFlash($msg);
                return $this->redirect($this->referer());
            } else {
                $msg = $this->generateError($this->Ticket->validationErrors);
                $this->Session->setFlash($msg);
            }
        }
        

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
//            pr($this->request->data);

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
                //   echo 'here'; exit;
                $this->request->data['Ticket']['priority'] = 'low';
                $this->request->data['Ticket']['status'] = 'solved';
                $status = 'solved';
            }
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
                $data = array(
                    'cancel_mac' => $mac,
                    'hold_date' => $this->request->data['Ticket']['hold_date']
                );
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
                    'unhold_date' => $this->request->data['Ticket']['unhold_date']
                );
                if (isset($this->request->data['mac'])) {
                    $mac = json_encode($this->request->data['mac']);
                    $data['cancel_mac'] = $mac;
                }
                $cusinfo = $this->PackageCustomer->save($data);
            }

            if (trim($this->request->data['Ticket']['issue_id']) == 20 || trim($this->request->data['Ticket']['issue_id']) == 28) {

                $this->request->data['Ticket']['cancelled_date'] = $this->getFormatedDate($this->request->data['Ticket']['cancelled_date']);
                $this->request->data['Ticket']['pickup_date'] = $this->getFormatedDate($this->request->data['Ticket']['pickup_date']);

                $this->updateCustomer('request to cancel', $customer_id);
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
        //  $this->Track->set($this->request->data);
        //$this->Track->id = $this->request->data['Track']['id'];
        unset($this->request->data['Track']['id']);
        $this->request->data['Track']['status'] = 'solved';

        $this->request->data['Track']['package_customer_id'] = $this->request->data['Track']['package_customer_id'];

        $loggedUser = $this->Auth->user();
        $this->request->data['Track']['forwarded_by'] = $loggedUser['id'];
//        pr($this->request->data);
//        exit;
        $this->Track->save($this->request->data['Track']);
        $this->Ticket->id = $this->request->data['Track']['ticket_id'];

        $data = $this->Ticket->saveField('status', 'solved');
//       pr($data); exit; 
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

        //  pr($roles); exit;
        $this->set(compact('data', 'users', 'roles', 'total_page', 'total'));
    }

    function assigned_to_me($page = 1) {
        $this->loadModel('Ticket');
        $this->loadModel('User');
        $this->loadModel('Role');
        $loggedUser = $this->Auth->user();
        $offset = --$page * $this->per_page;
//        pr($loggedUser['id']); exit;
        $tickets = $this->Ticket->query("SELECT * 
                                        FROM tickets t
                                        LEFT JOIN tracks tr ON tr.ticket_id = t.id
                                        left JOIN issues i ON tr.issue_id = i.id
                                        left join users fb on tr.forwarded_by = fb.id
                                        left join users sb on tr.solved_by = sb.id
                                        left join users usb on tr.unsolved_by = usb.id
                                        left JOIN roles fd ON tr.role_id = fd.id
                                        left JOIN users fi ON tr.user_id = fi.id
                                        left join package_customers pc on tr.package_customer_id = pc.id
                                        WHERE tr.ticket_id IN (SELECT ticket_id from tracks  tr where  tr.user_id  = " .
                $loggedUser['id'] . ")" . " ORDER BY tr.id DESC" . " LIMIT " . $offset . "," . $this->per_page);

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
        $tickets = $this->Ticket->query("SELECT * 
                                        FROM tickets t
                                        LEFT JOIN tracks tr ON tr.ticket_id = t.id
                                        left JOIN issues i ON tr.issue_id = i.id
                                        left join users fb on tr.forwarded_by = fb.id
                                        left join users sb on tr.solved_by = sb.id
                                        left join users usb on tr.unsolved_by = usb.id
                                        left JOIN roles fd ON tr.role_id = fd.id
                                        left JOIN users fi ON tr.user_id = fi.id
                                        left join package_customers pc on tr.package_customer_id = pc.id
                                        WHERE tr.ticket_id IN (SELECT ticket_id from tracks  tr where tr.forwarded_by = " .
                $loggedUser['id'] . ")" . " ORDER BY tr.id DESC" . " LIMIT " . $offset . "," . $this->per_page);


        $temp = $this->Ticket->query("SELECT COUNT( DISTINCT tr.ticket_id ) AS total FROM tracks tr WHERE tr.forwarded_by = " . $loggedUser['id']);

//          pr($temp); exit;    
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
//        pr($this->request->data);
//        exit;
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
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.status = 'open' ORDER BY tr.created DESC " . " LIMIT " . $offset . "," . $this->per_page);
        $temp = $this->Ticket->query("SELECT COUNT(tickets.id) as total FROM `tickets` WHERE tickets.status = 'open'");
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

    function solved_ticket($page = 1) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
        $offset = --$page * $this->per_page;

        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                         WHERE t.status = 'solved' ORDER BY tr.created DESC" . " LIMIT " . $offset . "," . $this->per_page);

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