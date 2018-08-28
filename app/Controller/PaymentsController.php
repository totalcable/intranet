<?php
App::uses('HttpSocket', 'Network/Http');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

class PaymentsController extends AppController {

    var $layout = 'admin';
    var $LivePayMode = 0; //zero means test mode
    public $components = array('Security', 'RequestHandler');

// public $components = array('Auth');
    public function isAuthorized($user = null) {
        $sidebar = $user['Role']['name'];
        $this->set(compact('sidebar'));
        return true;
    }

    public function beforeFilter() {
        if (!$this->Auth->loggedIn()) {
            return $this->redirect('/admins/login');
//  echo 'here'; exit; //(array('action' => 'deshboard'));
        }
        parent::beforeFilter();
// Allow users to register and logout.
        $this->Auth->allow('process');

        $this->img_config = array(
            'check_image' => array(
                'image_ratio_crop' => false,
            ),
            //for attachment upload 
            'file' => array(),
            'attachment' => array(
                'image_ratio_crop' => false,
            ),
            'parent_dir' => 'check_images',
            'target_path' => array(
                'check_image' => WWW_ROOT . 'check_images' . DS,
                'attachment' => WWW_ROOT . 'attachment' . DS
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

    public function getLastCardInfo($customer_id = null) {
        $this->loadModel('Transaction');
        $sql = "SELECT * FROM transactions WHERE (transactions.status ='success' OR transactions.status ='update') AND transactions.pay_mode='card' AND transactions.package_customer_id = $customer_id ORDER BY transactions.id DESC LIMIT 1";
        $temp = $this->Transaction->query($sql);
        $yyyy = 0;
        $mm = -1;
        $latestcardInfo = array('card_no' => '', 'exp_date' => array('year' => 0, 'month' => 0), 'fname' => '', 'lname' => '', 'cvv_code' => '', 'zip_code' => '', 'trx_id' => '');

        if (count($temp)) {
            $date = explode('/', $temp[0]['transactions']['exp_date']);
            if (count($date) != 2) {
                $date = explode('-', $temp[0]['transactions']['exp_date']);
            }
            $yyyy = date('Y');
            $yy = substr($yyyy, 0, 2);
            $digits = strlen((string) $date[1]);

            $yyyy = $date[1];
            if (isset($date[1]) && $digits < 4) {
                $yyyy = $yy . '' . $date[1];
            }
            $mm = $date[0];
            $temp[0]['transactions']['exp_date'] = array('year' => $yyyy, 'month' => $mm);
            $latestcardInfo = $temp[0]['transactions'];
        }
        return $latestcardInfo;
    }

    function getCredit($customer_id = 0) {
        $this->loadModel('Transaction');
        $sql = "SELECT SUM(payable_amount) as credit FROM transactions WHERE transactions.status = 'approved' AND package_customer_id = $customer_id";
        $temp = $this->Transaction->query($sql);
        return $temp[0][0]['credit'];
    }

    public function process($trans_id = null, $customer_id = null) {
        $ym = $this->getYm();
        $this->set(compact('ym'));
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $customer_info = $this->PackageCustomer->findById($customer_id);
        $this->request->data = $customer_info;
        $latestcardInfo = $this->getLastCardInfo($customer_id);
        unset($customer_info['PackageCustomer']['email']);
        unset($customer_info['PackageCustomer']['id']);
        unset($customer_info['PackageCustomer']['exp_date']);
        $data = $this->Transaction->findById($trans_id);
        $this->request->data['Transaction'] = $latestcardInfo;
        $this->request->data['Transaction']['id'] = $trans_id;
        $paid = getPaid($trans_id);
        $credit = $this->getCredit($customer_id);

        $data = $this->Transaction->findById($trans_id);
        $latestcardInfo['card_no'] = $this->formatCardNumber($latestcardInfo['card_no']);
        $this->request->data['Transaction'] = $latestcardInfo;
        $this->request->data['Transaction']['id'] = $data['Transaction']['id'];
        $this->request->data['Transaction']['payable_amount'] = $data['Transaction']['payable_amount'] - $paid - $credit;
        $this->set('customer_info');
    }
    
    
   
    public function request_process() {

        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Track');
        $this->loadModel('Ticket');

        if (strpos($this->request->data['Transaction']['card_no'], 'X') !== false) {
//Card number is not provided. So fetch previous card number
//  $temp = $this->Transaction->findById($this->request->data['Transaction']['id']);
            $latestcardInfo = $this->getLastCardInfo($this->request->data['Transaction']['package_customer_id']);
            $this->request->data['Transaction']['card_no'] = trim($latestcardInfo['card_no']);
        }

        $loggedUser = $this->Auth->user();
        if (count($loggedUser) == 0) {
            $loggedUser['id'] = 0;
        }
        $msg = '<ul>';
        $card = $this->request->data['Transaction'];
        $exp_date = $card['exp_date']['month'] . '-' . $card['exp_date']['year'];
        $this->request->data['Transaction']['exp_date'] = $exp_date;
        $cid = $this->request->data['Transaction']['package_customer_id'];
        $pc = $this->PackageCustomer->findById($cid);
// process payment

        if ($this->LivePayMode) {
            $this->request->data['marchantName'] = '7zKH4b45'; // live
            $this->request->data['marchantKey'] = '738QpWvHH4vS59vY'; // live
            $this->request->data['testMode'] = 0;
        } else {
            $this->request->data['marchantName'] = "95x9PuD6b2"; // testing
            $this->request->data['marchantKey'] = "547z56Vcbs3Nz9R9"; // testing
            $this->request->data['testMode'] = 1;
        }
        $link = 'http://www.api2apipro.live/' . 'rest_payments/add.json';
// $httpSocket = new HttpSocket();
        $httpSocket = new HttpSocket();
        //  unset($this->request->data['address']);
        $response = $httpSocket->post($link, $this->request->data);

        $result = $response->body;

        $return = json_decode($result, TRUE);
        $return = $return['return'];
//          pr($return); exit;
        if (!count($return)) {
            $transactionMsg = '<div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Update is required. Some code is not compatible for new version of cakephp or authorize api. Please update your module. </strong>
    </div>';
            $this->Session->setFlash($transactionMsg);

            return $this->redirect($this->referer());
        }

        $alert = '<div class="alert alert-success"> ';
        $amount = $this->request->data['Transaction']['payable_amount'];

        if ($return['result']['authenticated']) {

            if ($return['result']['tresponse']['status']) {
                $id = $this->request->data['Transaction']['id'];
                $this->request->data['Transaction']['transaction_id'] = $id;

                unset($return['Transaction']['id']);
                unset($this->request->data['Transaction']['id']);
//creatre transaction History 

                $transactionData = $this->Transaction->save($return['Transaction']);
                unset($this->request->data['Transaction']['transaction_id']);
                $status = 'close';
// check due amount 
                $due = $this->getDue($id);
                $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
// made credit as paid 
                $sql = "SELECT * FROM transactions WHERE status = 'approved' AND package_customer_id = " . $this->request->data['Transaction']['package_customer_id'];
                $temp = $this->Transaction->query($sql);
                foreach ($temp as $t) {
                    $this->Transaction->create();
                    $this->Transaction->id = $t['transactions']['id'];
                    $data = array('transaction_id' => $id, 'status' => 'paid');
                    $this->Transaction->save($data);
                }

                $due = $this->getDue($id);
                $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
                $totalDue = $due + $credit;
                if ($totalDue > 0) {
                    $status = 'open';
                }
                unset($this->request->data['Transaction']['payable_amount']);
                $this->Transaction->id = $id;
                $this->Transaction->saveField("status", $status);
                // $transactionID = $transactionData['Transaction']['id'];
                $msg .='<li> Transaction Successfull</li>';
                $ticket_content = "Transaction successfull <br>."
                        . " <b>Amount : </b>$amount <br>"
                        . " <b> Payment Mode: </b> Card <br>"
                        . " <b>Payment Date: </b> " . date('m-d-Y')
                        . "  <br> <b>Payment of: </b> #" . $id;
                // . " <b>Transaction ID:</b>".$transactionID;

                $tdata['Ticket'] = array('content' => $ticket_content);
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    //'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );

                $this->Track->save($trackData);

                if (strtolower($pc['PackageCustomer']['auto_r']) == 'yes') {
                    $data = $pc['PackageCustomer'];
                    $this->PackageCustomer->id = $data['id'];

                    $r_from = date('Y-m-' . $data['recurring_date'], strtotime("+" . $data['r_duration'] . " months", strtotime($data['r_form'])));

                    $exp_date = $card['exp_date']['month'] . '/' . substr($card['exp_date']['year'], -2);
                    $data = array(
                        'r_form' => $r_from,
                        'invoice_created' => 0,
                        'card_check_no' => $card['card_no'],
                        'exp_date' => $exp_date,
                        'cfirst_name' => $card['fname'],
                        'clast_name' => $card['lname'],
                        'cvv_code' => $card['cvv_code'],
                        'czip' => $card['zip_code']
                    );

                    $this->PackageCustomer->save($data);
                }
            } else {
                $alert = '<div class="alert alert-error"> ';
                $errorCode = $return['result']['tresponse']['Ecode'];

                if ($errorCode == 'E00003') {
                    $errorMsg = 'Invalid ZIP CODE OR Expiration Date.<br> <b> Error Code: ' . $errorCode . '</b>';
                } else if ($errorCode == 'E00007') {
                    $errorMsg = 'Transaction failed due to Marchant Account credential changed. Please contact with administrator <br> <b> Error Code: ' . $errorCode . '</b>';
                } else {
                    $errorMsg = $errorCode = $return['result']['tresponse']['Etext'] . '<br> <b> Error Code: ' . $errorCode . '</b>';
                }

                $msg .='<li>' . $errorMsg . ' </li>';

                $tdata['Ticket'] = array('content' => $errorMsg . "<br> <b>Amount</b> : $amount <br> <b> payment Mode: </b> Card");

                $tickect = $this->Ticket->save($tdata);

// Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
//                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
            }
        } else {
            $alert = '<div class="alert alert-error"> ';
            $msg .='<li> Transaction failed due to Marchant Account credential changed. Please contact with administrator</li>';
            $tdata['Ticket'] = array('content' => "Transaction failed due to Marchant Account credential changed. Please contact with administrator <br> <b> Amount : </b> $amount <br> <b> payment Mode: </b> Card");
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $cid,
                'ticket_id' => $tickect['Ticket']['id'],
//                'status' => 'closed',
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
        }

        $transactionMsg = $alert . '
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . $msg . '</strong>
    </div>';
        $this->Session->setFlash($transactionMsg);

        return $this->redirect($this->referer());
    }

    public function individual_auto_recurring($data) {
        foreach ($data as $key => $value):
            $data[$key] = trim($value);
        endforeach;
//Get ID and Input amount from edit_customer page
        $cid = $data['cid'];
        $this->layout = 'ajax';
        $this->request->data['card'] = $data;

        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
// $loggedUser = $this->Auth->user();
        $transaction['user_id'] = 0;

        $amount = $data['payable_amount'];
        $msg = '<ul>';

        $link = 'http://www.api2apipro.live/' . 'rest_payments/edit.json';

        $httpSocket = new HttpSocket();

        if ($this->LivePayMode) {
            $this->request->data['marchantName'] = '7zKH4b45'; // live
            $this->request->data['marchantKey'] = '738QpWvHH4vS59vY'; // live
            $this->request->data['testMode'] = 0;
        } else {
            $this->request->data['marchantName'] = "95x9PuD6b2"; // testing
            $this->request->data['marchantKey'] = "547z56Vcbs3Nz9R9"; // testing
            $this->request->data['testMode'] = 1;
        }

        $response = $httpSocket->put($link, $this->request->data);
        $result = $response->body;
        $return = json_decode($result, TRUE);
        $return = $return['return'];

        if ($return['result']['authenticated']) {
            if ($return['result']['tresponse']['status']) {

                $transaction['status'] = 'success';
                $id = $data['id'];
                $transaction['transaction_id'] = $id;

//creatre transaction History 
                $this->Transaction->create();
                $this->Transaction->save($return['Transaction']);
                unset($transaction['transaction_id']);
                $status = 'close';
// check due amount 
                unset($transaction['payable_amount']);
                $this->Transaction->id = $id;
//$this->Transaction->create();
                $this->Transaction->saveField("status", $status);

                $msg .='<li> Transaction successfull by auto recurring</li>';
                $ticket_content = "Transaction successfull by auto recurring <br>."
                        . " <b>Amount : </b>$amount <br>"
                        . " <b> payment Mode: </b> Card <br>"
                        . " <b>Payment Date: </b> " . date('m-d-Y')
                        . "  <br> <b>Payment of: </b> #" . $id;
                // . " <b>Transaction ID:</b>".$transactionID;
                $tdata['Ticket'] = array('content' => $ticket_content, 'status' => 'open');
                $tickect = $this->Ticket->create(); // Data save in Ticket
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    'forwarded_by' => 0
                );
                $this->Track->create();
                $this->Track->save($trackData);
// reset setting for next cycle
                $this->PackageCustomer->create();
                $this->PackageCustomer->id = $data['cid'];
                $r_from = date('Y-m-d', strtotime('+' . $data['duration'] . '  days'));
                $r_from = date('Y-m-' . $data['day'], strtotime("+" . $data['duration'] . " months", strtotime($data['from'])));
                $this->PackageCustomer->saveField('r_form', $r_from);
                $this->PackageCustomer->saveField('invoice_created', 0);
            } else {
                $alert = '<div class="alert alert-error"> ';
                $errorCode = $return['result']['tresponse']['Ecode'];
                if ($errorCode == 'E00003') {
                    $errorMsg = 'This payment attempt was from auto recurring. Invalid Card number. Check Card Number, remove space or any special carachter inserted by mistkae <br> <b> Error Code: ' . $errorCode . '</b>';
                } else if ($errorCode == 'E00007') {
                    $errorMsg = 'This payment attempt was from auto recurring. Transaction failed due to Marchant Account credential changed. Please contact with administrator <br> <b> Error Code: ' . $errorCode . '</b>';
                } else {
                    $errorMsg = $return['result']['tresponse']['Etext'] . '<br> <b> Error Code: ' . $errorCode . '</b>';
                }
                $msg .='<li>' . $errorMsg . ' </li>';
                $tdata['Ticket'] = array('content' => $errorMsg . "<br> <b>Amount</b> : $amount <br> <b> payment Mode: </b> Card",
                    'auto_recurring' => $amount);
                $tickect = $this->Ticket->create();
                $tickect = $this->Ticket->save($tdata);
// Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    // 'status' => 'closed',
                    'forwarded_by' => 0
                );
                $this->Track->create();
                $this->Track->save($trackData);

                $this->PackageCustomer->create();
                $this->PackageCustomer->id = $data['cid'];
                $this->PackageCustomer->saveField('auto_recurring_failed', 1);
            }
        } else {
            $alert = '<div class="alert alert-error"> ';
            $msg .='<li> This payment attempt was from auto recurring. Transaction failed due to Marchant Account credential changed. Please contact with administrator</li>';
            $tdata['Ticket'] = array('content' => "This payment attempt was from auto recurring. Transaction failed due to Marchant Account credential changed. Please contact with administrator <br> <b> Amount : </b> $amount <br> <b> payment Mode: </b> Card",
                'auto_recurring' => $amount);
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $cid,
                'ticket_id' => $tickect['Ticket']['id'],
                // 'status' => 'closed',
                'forwarded_by' => 0
            );
            $this->Track->create();
            $this->Track->save($trackData);

            $this->PackageCustomer->create();
            $this->PackageCustomer->id = $data['cid'];
            $this->PackageCustomer->saveField('auto_recurring_failed', 1);
        }
//$this->set(compact('msg'));
    }

    function auto_recurring_invoice() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('AutoRecurring');
        $this->loadModel('Transactions');

// $sql = 'SELECT * FROM package_customers WHERE  LOWER(package_customers.auto_r) ="yes" AND package_customers.invoice_created = 0';
//$pcs = $this->PackageCustomer->query($sql);
        //$pcs = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.auto_r' => 'yes', 'PackageCustomer.invoice_created' => 0, 'PackageCustomer.invoice_created' => 0)));

        $today = date('Y-m-d');
        $sql = "SELECT * FROM transactions
                LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id               
                WHERE package_customers.auto_r = 'yes' AND package_customers.invoice_created = 0 
                AND transactions.next_payment = '$today'";
//                echo $sql; exit;
        $pcs = $this->PackageCustomer->query($sql);
 //pr($pcs); exit;
//echo $this->packageCustomer->getLastQuery();
        $success = 0;
        $failure = 0;
        foreach ($pcs as $single) {

            $pc = $single['PackageCustomer'];
            $duration = $pc['r_duration'];
            $rFrom = $pc['r_form'];
//            $Date = "2010-09-17";
//            echo date('Y-m-d', strtotime($Date . ' + 1 days'));
//echo $rFrom; exit;
            $temp = date('Y-m-d', strtotime($rFrom . '-15  days'));
//   echo $temp.'<br>';
            $deadline = strtotime($temp);
            $temp = date('Y-m-d');
//   echo $temp.'<br>';
            $now = strtotime($temp);
//  echo $now.'<br>';
//   echo $deadline; exit;
            if ($now >= $deadline) { // this is prior 15 days of payment date. So generate invoice 
//     echo 'here'; exit;
                $data['Transaction'] = array(
                    'package_customer_id' => $pc['id'],
                    'note' => 'This Invoice is generated from system',
                    'discount' => 0,
                    'status' => 'open',
                    'next_payment' => $rFrom,
                    'auto_recurring' => 1,
                    'payable_amount' => $pc['payable_amount']
                );
//                pr($data);
//                exit;
                $this->generateInvoice($data);
                $this->PackageCustomer->create();
                $this->PackageCustomer->id = $pc['id'];
                $this->PackageCustomer->saveField('invoice_created', 1);
            }
        }
    }

    function auto_recurring_payment() {
        $this->loadModel('Transaction');
//  $this->loadModel('PackageCustomer');
        $today = date('Y-m-d');
        $sql = "SELECT * FROM transactions"
                . " LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id"
                . " WHERE transactions.auto_recurring = 1 AND package_customers.auto_recurring_failed = 0 "
                . "AND transactions.next_payment <= '$today' AND transactions.status = 'open'";

// $data = $this->Transaction->find('all', array('conditions' => array('auto_recurring' => 1, 'next_payment' => $today)));
        $data = $this->Transaction->query($sql);

        foreach ($data as $single) {
            $transaction = $single['transactions'];
            $pc = $single['package_customers'];
            $data = array(
                'exp_date' => $pc['exp_date'],
                'card_no' => $pc['card_check_no'],
                'cvv_code' => $pc['cvv_code'],
                'fname' => $pc['cfirst_name'],
                'lname' => $pc['clast_name'],
                'company' => '',
                'address' => $pc['street'] . ' ' . $pc['apartment'],
                'city' => $pc['city'],
                'state' => $pc['state'],
                'zip_code' => $pc['zip'],
                'country' => '',
                'phone' => $pc['cell'],
                'fax' => $pc['fax'],
                'payable_amount' => $transaction['payable_amount'],
                'cid' => $pc['id'],
                'id' => $transaction['id'],
                'duration' => $pc['r_duration'],
                'day' => $pc['recurring_date'],
                'from' => $pc['r_form']
            );
            $this->individual_auto_recurring($data);
        }
        //return $this->redirect('message');
    }

    function message() {
        
    }   
     

    function refundTransaction() {
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
// Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        //  $merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
        $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        // $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();

        $creditCard->setCardNumber($this->request->data['Transaction']['card_no']);
//$creditCard->setCardNumber("0015");
        $dateObj = $this->request->data['Transaction']['exp_date'];
        $this->request->data['Transaction']['exp_date'] = $dateObj['month'] . '/' . substr($dateObj['year'], -2);
        $creditCard->setExpirationDate($this->request->data['Transaction']['exp_date']);
// $creditCard->setExpirationDate("XXXX");
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
//create a transaction
        $transactionRequest = new AnetAPI\TransactionRequestType();
        $transactionRequest->setTransactionType("refundTransaction");
        $transactionRequest->setAmount($this->request->data['Transaction']['refund_amount']);
        $transactionRequest->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequest);
        $controller = new AnetController\CreateTransactionController($request);
//$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $msg = '';

        $data4transaction['Transaction']['exp_date'] = $this->request->data['Transaction']['exp_date'];

        $data4transaction['Transaction']['card_no'] = $this->request->data['Transaction']['card_no'];
        $data4transaction['Transaction']['user_id'] = $loggedUser['id'];




        if ($response != null) {
            $tresponse = $response->getTransactionResponse();

            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $data4transaction['Transaction']['paid_amount'] = $this->request->data['Transaction']['refund_amount'];
                $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
                $data4transaction['Transaction']['status'] = 'Refund Successful';
//   $data4transaction['Transaction']['trx_id'] = $tresponse->getTransId();
                $msg = ' <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund SUCCESS</strong>
                </p> </div>';

                $tdata['Ticket'] = array('content' => 'Refund successfull', 'status' => 'solved');
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
            } else {
                $data4transaction['Transaction']['paid_amount'] = 0;
                $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
                $data4transaction['Transaction']['status'] = 'Refund failed';
                $data4transaction['Transaction']['error_msg'] = "Refund ERROR : "; //. $tresponse->getResponseCode();
                $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund ERROR  ' . //$tresponse->ResponseCode() . 
                        '</strong> </p> </div>';

                $tdata['Ticket'] = array('content' => 'Refund failed for Null response', 'status' => 'solved');

                $tickect = $this->Ticket->save($tdata['Ticket']); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                    'ticket_id' => $tickect['Ticket']['id'],
                    'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );
                $this->Track->save($trackData);
            }
        } else {
            $data4transaction['Transaction']['paid_amount'] = 0;
            $data4transaction['Transaction']['package_customer_id'] = $this->request->data['Transaction']['cid'];
            $data4transaction['Transaction']['status'] = 'Refund failed';
            $data4transaction['Transaction']['error_msg'] = "Refund Null response returned";
            $msg .='Refund failed for Null response';
            $msg = ' <div class="alert alert-block alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p> <strong>Refund failed for Null response  </strong> </p> </div>';


            $tdata['Ticket'] = array('content' => 'Transaction ' . ' Refund failed for Null response', 'status' => 'solved');
            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
            $trackData['Track'] = array(
                'package_customer_id' => $data4transaction['Transaction']['package_customer_id'],
                'ticket_id' => $tickect['Ticket']['id'],
                'status' => 'open',
                'forwarded_by' => $loggedUser['id']
            );
            $this->Track->save($trackData);
//            $tdata4ticket['Ticket'] = array('content' => 'Refund for ' . $pc['fname'] . ' ' . $pc['lname'] . ' failed for Charge Credit card Null response');
//            $tickect = $this->Ticket->save($tdata); // Data save in Ticket
//            $trackData['Track'] = array(
//                'package_customer_id' => $cid,
//                'ticket_id' => $tickect['Ticket']['id'],
//                'status' => 'open',
//                'forwarded_by' => $loggedUser['id']
//            );
//            $this->Track->save($trackData);
//  echo "Refund Null response returned";
        }
        $this->loadModel('Transaction');

        $data4transaction['Transaction']['pay_mode'] = 'refund';
        $this->Transaction->save($data4transaction);
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function createTransactionHistory($data = array()) {
        $this->loadModel('PaidTransaction');
        $this->PaidTransaction->save($data);
    }

    function getDue($id = null) {
        $this->loadModel('Transaction');
        $data1 = $this->Transaction->findById($id);
        $sql = "SELECT SUM(payable_amount) as paid FROM transactions WHERE transaction_id =" . $id;

        $data2 = $this->Transaction->query($sql);
        $payable = $data1['Transaction']['payable_amount'];
        $paid = $data2[0][0]['paid'];
        $paid = round($paid, 2);

        return $payable - $paid;
    }

    public function individual_transaction_by_check() {
        $transactionDate = $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created_check']) . ' 00:00:00';
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $result = array();
        if (!empty($this->request->data['Transaction']['check_image']['name'])) {
            $result = $this->processImg($this->request->data['Transaction'], 'check_image');
            $this->request->data['Transaction']['check_image'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['check_image'] = '';
        }
        $this->request->data['Transaction']['status'] = 'success';
        $id = $this->request->data['Transaction']['id'];
        $this->request->data['Transaction']['transaction_id'] = $id;
        unset($this->request->data['Transaction']['id']);

//creatre transaction History 
        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);


// made credit as paid 
        $sql = "SELECT * FROM transactions WHERE status = 'approved' AND package_customer_id = " . $this->request->data['Transaction']['package_customer_id'];
        $temp = $this->Transaction->query($sql);
        foreach ($temp as $t) {
            $this->Transaction->create();
            $this->Transaction->id = $t['transactions']['id'];
            $data = array('transaction_id' => $id, 'status' => 'paid');
            $this->Transaction->save($data);
        }

        $due = $this->getDue($id);
        $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
        $totalDue = $due + $credit;
        $status = 'close';
        if ($totalDue > 0) {
            $status = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;
        $this->request->data['Transaction']['status'] = $status;
        $this->Transaction->save($this->request->data['Transaction']);
// generate Ticket

        $dt = date('m-d-Y', strtotime($transactionDate));
        $ticket_content = "Transaction successfull by cheque <br>"
                . " <b>Amount: </b>$amount <br>"
                . " <b>payment Mode: </b> Cheque <br>"
                . " <b>Payment Date: </b> " . $dt
                . "  <br> <b>Payment of: </b> #" . $id;
        $tdata['Ticket'] = array('content' => $ticket_content, 'payment_process' => '2');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'open',
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData);
// End generate Ticket
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_morder() {
        $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created_morder']) . ' 00:00:00';
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $result = array();
        if (!empty($this->request->data['Transaction']['check_image']['name'])) {
            $result = $this->processImg($this->request->data['Transaction'], 'check_image');
            $this->request->data['Transaction']['check_image'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['check_image'] = '';
        }
        $this->request->data['Transaction']['status'] = 'success';
        $id = $this->request->data['Transaction']['id'];
        $this->request->data['Transaction']['transaction_id'] = $id;
        unset($this->request->data['Transaction']['id']);


//creatre transaction History 
        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);


// made credit as paid 
        $sql = "SELECT * FROM transactions WHERE status = 'approved' AND package_customer_id = " . $this->request->data['Transaction']['package_customer_id'];
        $temp = $this->Transaction->query($sql);
        foreach ($temp as $t) {
            $this->Transaction->create();
            $this->Transaction->id = $t['transactions']['id'];
            $data = array('transaction_id' => $id, 'status' => 'paid');
            $this->Transaction->save($data);
        }

        $due = $this->getDue($id);
        $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
        $totalDue = $due + $credit;
        $status = 'close';
        if ($totalDue > 0) {
            $status = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;
        $this->request->data['Transaction']['status'] = $status;
        $this->Transaction->save($this->request->data['Transaction']);
// generate Ticket
        $date = $this->request->data['Transaction']['created'];
        $dt = date('m-d-Y', strtotime($date));
        $ticket_content = "Transaction successfull by money order<br>"
                . " <b>Amount : </b>$amount <br>"
                . " <b> payment Mode: </b> Money Order <br>"
                . " <b>Payment Date: </b> " . $dt
                . "  <br> <b>Payment of: </b> #" . $id;
        $tdata['Ticket'] = array('content' => $ticket_content, 'status' => 'open', 'payment_process' => '2');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'open',
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData);
// End generate Ticket

        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_online_bil() {
        $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created_onlinebill']) . ' 00:00:00';
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];

        $result = array();
        if (!empty($this->request->data['Transaction']['check_image']['name'])) {
            $result = $this->processImg($this->request->data['Transaction'], 'check_image');
            $this->request->data['Transaction']['check_image'] = (string) $result['file_dst_name'];
        } else {
            $this->request->data['Transaction']['check_image'] = '';
        }


        $id = $this->request->data['Transaction']['id'];
        $this->request->data['Transaction']['transaction_id'] = $id;
        unset($this->request->data['Transaction']['id']);

//creatre transaction History 
        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);
        $this->request->data['Transaction']['status'] = 'close';

// made credit as paid 
        $sql = "SELECT * FROM transactions WHERE status = 'approved' AND package_customer_id = " . $this->request->data['Transaction']['package_customer_id'];
        $temp = $this->Transaction->query($sql);

        foreach ($temp as $t) {
            $this->Transaction->create();
            $this->Transaction->id = $t['transactions']['id'];
            $data = array('transaction_id' => $id, 'status' => 'paid');
            $this->Transaction->save($data);
        }

        $due = $this->getDue($id);
        $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
        $totalDue = $due + $credit;
        $status = 'close';
        if ($totalDue > 0) {
            $status = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;
        $this->request->data['Transaction']['status'] = $status;
        $this->Transaction->save($this->request->data['Transaction']);

// generate Ticket      
        $date = $this->request->data['Transaction']['created'];
        $dt = date('m-d-Y', strtotime($date));
        $ticket_content = "Transaction successfull by Online Bil <br>"
                . " <b>Amount : </b>$amount <br>"
                . " <b> payment Mode: </b> Online Bill <br>"
                . " <b>Payment Date: </b> " . $dt
                . "  <br> <b>Payment of: </b> #" . $id;
        $tdata['Ticket'] = array('content' => $ticket_content, 'status' => 'open', 'payment_process' => '2');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'open',
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData);

// End generate Ticket
        $this->Transaction->id = $id;
        $this->Transaction->save($this->request->data['Transaction']);
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_cash() {
        $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created_cash']) . ' 00:00:00';
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $this->request->data['Transaction']['status'] = 'success';
        $id = $this->request->data['Transaction']['id'];
        $this->request->data['Transaction']['transaction_id'] = $id;
        unset($this->request->data['Transaction']['id']);
//creatre transaction History 

        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);



// made credit as paid 
        $sql = "SELECT * FROM transactions WHERE status = 'approved' AND package_customer_id = " . $this->request->data['Transaction']['package_customer_id'];
        $temp = $this->Transaction->query($sql);
        foreach ($temp as $t) {
            $this->Transaction->create();
            $this->Transaction->id = $t['transactions']['id'];
            $data = array('transaction_id' => $id, 'status' => 'paid');
            $this->Transaction->save($data);
        }

        $due = $this->getDue($id);
        $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
        $totalDue = $due + $credit;
        $status = 'close';
        if ($totalDue > 0) {
            $status = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;
        $this->request->data['Transaction']['status'] = $status;
        $this->Transaction->save($this->request->data['Transaction']);

// generate Ticket                
        $date = $this->request->data['Transaction']['created'];
        $dt = date('m-d-Y', strtotime($date));
        $ticket_content = "Transaction successfull by Cash <br>"
                . " <b>Amount : </b>$amount <br>"
                . " <b>Payment Mode: </b> Cash <br>"
                . " <b>Payment Date: </b> " . $dt
                . "  <br> <b>Payment of: </b> #" . $id;
        $tdata['Ticket'] = array('content' => $ticket_content, 'payment_process' => '2');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'open',
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData);
// End generate Ticket

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
//        $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created']) . ' 00:00:00';
        if ($this->request->is('post')) {
            $this->Transaction->set($this->request->data);
            if ($this->Transaction->validates()) {
                $temp = explode('/', $this->request->data['Transaction']['created']);
                $this->request->data['Transaction']['created'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1] . ' 00:00:00';
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

    public function paidInvoice($trans_id = null, $customer_id = null) {
        $transactionDate = $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created']) . ' 00:00:00';
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $this->request->data['Transaction']['user_id'] = $loggedUser['id'];
        $result = array();
        $this->request->data['Transaction']['status'] = 'paid';
        $id = $this->request->data['Transaction']['id'];
        $this->request->data['Transaction']['transaction_id'] = $id;
        if (strpos($this->request->data['Transaction']['card_no'], 'X') !== false) {
//Card number is not changed. So fetch previous card number
            $card = $this->getLastCardInfo($this->request->data['Transaction']['package_customer_id']);
            $this->request->data['Transaction']['card_no'] = $card['card_no'];
        }

        unset($this->request->data['Transaction']['id']);

//creatre transaction History 

        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);
        unset($this->request->data['Transaction']['created']);

        $status = 'close';
// check due amount 
        $due = $this->getDue($id);
// echo 'Due : '.$due; exit;
        if ($due > 0) {
            $status = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;

        $this->Transaction->saveField('status', $status);
//        echo $this->Transaction->getLastQuery();
//        exit;
// generate Ticket
        $dt = date('m-d-Y', strtotime($transactionDate));
//        pr($dt); exit;
        $ticket_content = "Transaction successfull<br>"
                . " <b>Amount : </b>$amount <br>"
                . " <b>Payment Mode: </b> Card(Payment date was editable) <br>"
                . " <b>Payment Date: </b> " . $dt
                . " <br> <b>Payment of: </b> #" . $id;
        $tdata['Ticket'] = array('content' => $ticket_content, 'status' => 'solved');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'closed',
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData);
// End generate Ticket
        $transactionMsg = '<div class = "alert alert-success">
                        <button type = "button" class = "close" data-dismiss = "alert">&times;
                        </button>
                        <strong> Paid invoice record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
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

    function adjustmentMemoEdit($id = NULL) {
        $this->loadModel('Transaction');
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Transaction']['next_payment'] = $this->getFormatedDate($this->request->data['Transaction']['next_payment']);
            $this->Transaction->id = $this->request->data['Transaction']['id'];

            $result = array();
            $attach = $this->Transaction->findById($id);
            $directory = WWW_ROOT . 'attachment';

            if (!empty($this->request->data['Transaction']['attachment']['name'])) {
                $result = $this->processAttachment($this->request->data['Transaction'], 'attachment');
                if (unlink($directory . DIRECTORY_SEPARATOR . $attach['Transaction']['attachment']))
                    $this->request->data['Transaction']['attachment'] = (string) $result['file_dst_name'];
            } else {
                $this->request->data['Transaction']['attachment'] = $attach['Transaction']['attachment'];
            }

            $data = $this->removeEmptyElement($this->request->data['Transaction']);
            unset($data['id']);
            $this->Transaction->save($data);
            $msg = '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully insert data </strong></div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $data = $this->Transaction->findById($id);
        $this->request->data = $data;
    }

    public function processAutoRecurring($status = null) {

        $msg = 'This is the tool to run auto recurring script.Please follow the following steps strictly: '
                . '<br>'
                . "Click the 'Start Processing' button to start auto recurring. When you click on 'Start Processing' button don't move forward to any tab or link until process is completed"
                . '<br><br>'
                . '<a id="autoRecurringBtn" class="btn purple btn-block" href="' . Router::url(array('controller' => 'payments', 'action' => 'processAutoRecurring', 'processing')) . '">Start Processing</a>';

        if ($status == "processing") {
            $this->auto_recurring_invoice();
            $this->auto_recurring_payment();
            $this->redirect($this->referer() . '/done');
        }

        if ($status == 'done') {
            $msg = '<i class="fa fa-check">Complete</i>';
        }
        $this->set(compact('msg'));
    }

}

?>