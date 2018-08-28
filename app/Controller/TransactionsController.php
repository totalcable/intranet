<?php

/**
 * 
 */
App::uses('CakeEmail', 'Network/Email');
App::uses('HttpSocket', 'Network/Http');
App::uses('AppController', 'Controller');


require_once(APP . 'Vendor' . DS . 'authorize' . DS . 'autoload.php');
require_once(APP . 'Vendor' . DS . 'class.upload.php');

//App::uses('AnetAPI', 'net\authorize\api\contract\v1');
//App::uses('AnetController', 'net\authorize\api\controller');
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

define("AUTHORIZENET_LOG_FILE", APP . 'Vendor' . DS . 'authorize' . DS . 'phplog');

class TransactionsController extends AppController {

    var $layout = 'admin';
    // public $components = array('Auth');
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email', //Default is 'username' in the userModel
                        'password' => 'password'  //Default is 'password' in the userModel
                    ),
                    'userModel' => 'User',
                )
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ), array('Security', 'RequestHandler'),
            'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => '/', 'action' => 'index'),
            'authError' => "You can't acces that page",
            'authorize' => 'Controller'
        )
    );

    public function isAuthorized($user = null) {
        $sidebar = $user['Role']['name'];
        $this->set(compact('sidebar'));
        return true;
    }

    function registered($id = null) {
        $this->loadModel('PackageCustomer');
        $this->loadModel('User');

        $user_id = $this->Auth->user(['id']);
        $customer_info = $this->PackageCustomer->find('all', array('conditions' => array('user_id' => $id)));
        $this->set(compact('customer_info'));
    }

    function search() {
        $this->loadModel('Transaction');
        ;
        $clicked = false;
        $datrange = json_decode($this->request->data['Transaction']['daterange'], true);
        //$conditions = array('Transaction.created >=' => $datrange['start'], 'Transaction.created <=' => $datrange['end']);
        $transactions = $this->Transaction->find('all');
        $clicked = true;
        $this->set(compact('transactions'));
        $this->set(compact('clicked'));
    }

    function expire_customer($id = null) {
        $this->loadModel('PaidCustomer');
        $clicked = false;
        //$datrange = json_decode($this->request->data['paidcustomer']['daterange'], true);
        //$conditions = array('PaidCustomer.exp_date >=' => $datrange['start'], 'PaidCustomer.exp_date <=' => $datrange['end']);
        $paidcustomers = $this->PaidCustomer->find('first', array('conditions' => array('PaidCustomer.id' => $id)));
        //pr($paidcustomers); exit;
        $clicked = true;
        $this->set(compact('paidcustomers'));
        $this->set(compact('clicked'));
    }

    function manage() {
        $this->loadModel('Transaction');
        $data_info = $this->Transaction->find('all');
        $this->set(compact('data_info'));
    }

    function tariffplan() {
        $this->loadModel('Psetting');
        $this->loadModel('Package');
        $sql = "SELECT *  FROM packages
                LEFT JOIN psettings ON packages.id=psettings.package_id ORDER BY packages.id ASC";
        $info = $this->Package->query($sql);
        $filteredPackage = array();
        $unique = array();
        $index = 0;
        foreach ($info as $key => $menu) {
            //pr($menu); exit;
            $pm = $menu['packages']['name'];
            if (isset($unique[$pm])) {
                //  echo 'already exist'.$key.'<br/>';
                if (!empty($menu['psettings']['duration'])) {
                    $temp = array('id' => $menu['psettings']['id'], 'duration' => $menu['psettings']['duration'], 'amount' => $menu['psettings']['amount'], 'offer' => $menu['psettings']['offer']);
                    //pr($temp); exit;
                    $filteredPackage[$index]['psettings'][] = $temp;
                }
            } else {
                if ($key != 0)
                    $index++;
                $unique[$pm] = 'set';
                $temp = array('name' => $pm, 'id' => $menu['packages']['id']);
                $filteredPackage[$index]['packages'] = $temp;
                if (!empty($menu['psettings']['duration'])) {
                    $temp = array('id' => $menu['psettings']['id'], 'duration' => $menu['psettings']['duration'], 'amount' => $menu['psettings']['amount'], 'offer' => $menu['psettings']['offer']);
                    $filteredPackage[$index]['psettings'][] = $temp;
                }
            }
        }
        $this->set(compact('filteredPackage'));
    }

    function edit($cid, $id = null) {
        $this->loadModel('PackageCustomer');

        $this->loadModel('Transaction');
        if ($this->request->is('post') || $this->request->is('put')) {
            $loggedUser = $this->Auth->user();
            $tData = array(
                'issue_id' => 0,
                'forwarded_by' => $loggedUser['id'],
                'customer_id' => $cid,
                'user_id' => 0,
                'role_id' => 0,
                'status' => 'solved',
                'content' => '#' . $this->request->data['Transaction']['id'] . ' Invoice edited by ' . $loggedUser['name'] . '. This ticket is generated by system.',
            );
            $this->create_ticket($tData);
            $this->request->data['Transaction']['next_payment'] = $this->getFormatedDate($this->request->data['Transaction']['next_payment']);
            $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created']);
            $this->Transaction->set($this->request->data);

            $this->Transaction->id = $id;
//            pr($this->request->data['Transaction']); exit;
            $this->Transaction->save($this->request->data['Transaction']);
            $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Transaction data has been updated succeesfully </strong>
	</div>';
            $this->Session->setFlash($msg);
            return $this->redirect($this->referer());
        }
        $data = $this->Transaction->findById($id);
        $this->request->data['Transaction'] = $data['Transaction'];
    }

    function updatecardinfo() {
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->request->data['Transaction']['user_id'] = $user_id;
        $this->request->data['Transaction']['exp_date'] = $this->request->data['PackageCustomer']['exp_date']['month'] . '/' . $this->request->data['PackageCustomer']['exp_date']['year'];
        $this->request->data['Transaction']['package_customer_id'] = $this->request->data['PackageCustomer']['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> Card information has been updated successfully </strong>
            </div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function extrainvoice() {
        $this->request->data['Transaction']['next_payment'] = $this->getFormatedDate($this->request->data['Transaction']['next_payment']);
        $this->loadModel('Transaction');
        $user_info = $this->Auth->user();
        $user_id = $user_info['id'];
        $this->Transaction->save($this->request->data['Transaction']);
        $msg = '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Addisional invoice has been created successfully</strong>
            </div>';
        $this->Session->setFlash($msg);
        // return $this->redirect(array('controller' => 'reports', 'action' => 'extraPayment'));
        return $this->redirect($this->referer());
    }

    function void($id = null) {
        $this->loadModel('Transaction');
        $this->loadModel('PackageCustomer');
        $temp = $this->Transaction->findById($id);

        if ($temp['PackageCustomer']['auto_r'] == 'yes') {
            $this->PackageCustomer->id = $temp['PackageCustomer']['id'];
            $this->PackageCustomer->saveField("invoice_created", 0);
        }
        $this->Transaction->id = $id;
        $this->Transaction->saveField("status", "void");
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong> Record has been succeesfully updated as void </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function refundTransaction() {
        $this->loadModel('Transaction');
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $loggedUser = $this->Auth->user();

// Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        //API Login ID
        $merchantAuthentication->setName("5Rx77cdF2EE"); // testing mode //5Rx77cdF2EE
//      $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
        //Current Transaction Key:
        $merchantAuthentication->setTransactionKey("8kL6269fdrR3m8Bp");  // testing mode //8kL6269fdrR3m8Bp
//      $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX
        
        
//        $merchantAuthentication->setName("5Rx77cdF2EE"); // testing mode
//        //  $merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
//        $merchantAuthentication->setTransactionKey("8kL6269fdrR3m8Bp");  // testing mode
//        // $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
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
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        pr($response); exit;
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

    function getDue($id = null) {
        $this->loadModel('Transaction');
        $data1 = $this->Transaction->findById($id);
        $sql = "SELECT SUM(payable_amount) as paid FROM transactions WHERE transaction_id =" . $id;
//        echo $sql; exit;
        $data2 = $this->Transaction->query($sql);
        $payable = $data1['Transaction']['payable_amount'];
        $paid = $data2[0][0]['paid'];
        $paid = round($paid, 2);

        return $payable - $paid;
    }

    function getCredit($cid = 0) {
        $this->loadModel('Transaction');
        $sql = "SELECT SUM(payable_amount) as credit FROM transactions WHERE transactions.status = 'open' AND package_customer_id = $cid";
        $temp = $this->Transaction->query($sql);
        return $temp[0][0]['credit'];
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

    public function individual_transaction_by_card() {
        $this->loadModel('Transaction');
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        $this->loadModel('PackageCustomer');
        $this->loadModel('Log');
        $cid = $this->request->data['Transaction']['package_customer_id'];
        $pc = $this->PackageCustomer->findById($cid);
        $this->loadModel('Log');  
        $this->Log->save($this->log_info()); // log information
        if (strpos($this->request->data['Transaction']['card_no'], 'X') !== false) {
            //Card number is not provided. So fetch previous card number
            //  $temp = $this->Transaction->findById($this->request->data['Transaction']['id']);
            $latestcardInfo = $this->getLastCardInfo($this->request->data['Transaction']['package_customer_id']);
            $this->request->data['Transaction']['card_no'] = trim($latestcardInfo['card_no']);
        }

//        $this->request->data['Transaction']['card_no'] = trim(38000000000006);
        // PROCESS PAYMENT
        // Common setup for API credentials  
        $loggedUser = $this->Auth->user();
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();

        //API Login ID
        $merchantAuthentication->setName("5Rx77cdF2EE"); // testing mode //5Rx77cdF2EE
//         $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
        //Current Transaction Key:
        $merchantAuthentication->setTransactionKey("8kL6269fdrR3m8Bp");  // testing mode //8kL6269fdrR3m8Bp
//        $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX      

        $refId = 'ref' . time();

// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $msg = '<ul>';
        //$this->request->data['Transaction']['id'] = $cid;
        $card = $this->request->data['Transaction'];
        $cid = $this->request->data['Transaction']['package_customer_id'];

        $creditCard->setCardNumber($card['card_no']);
        $exp_date = $card['exp_date']['month'] . '-' . $card['exp_date']['year'];
        $this->request->data['Transaction']['exp_date'] = $exp_date;

        // echo $exp_date; exit;
        $creditCard->setExpirationDate($exp_date);
        //    $creditCard->setCardNumber("4117733943147221"); // live
        // $creditCard->setExpirationDate("07-2019"); //live

        $creditCard->setcardCode($card['cvv_code']); //live
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //    Bill To
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($card['fname']);
        $billto->setLastName($card['lname']);
        //$billto->setCompany($card['company']);
        //$billto->setAddress("14 Main Street");
        //$billto->setAddress($card['address']);
        $billto->setCity($card['city']);
        $billto->setState($card['state']);
        $billto->setZip($card['zip_code']);
        //$billto->setCountry($card['country']);
        $billto->setphoneNumber($card['phone']);
        //$billto->setfaxNumber($card['fax']);

        $paymentprofile = new AnetAPI\CustomerPaymentProfileType();

        $paymentprofile->setCustomerType('individual');
        $paymentprofile->setBillTo($billto);
        $customerProfile = new AnetAPI\CreateCustomerPaymentProfileRequest();
        $customerProfile->setPaymentProfile($paymentprofile);

        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($card['payable_amount']); // to do set amount from form
        $transactionRequestType->setPayment($paymentOne);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);

        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
//        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        $this->Log->save($this->log_info()); // log information
        $this->request->data['Transaction']['error_msg'] = '';
        $this->request->data['Transaction']['status'] = '';
        $this->request->data['Transaction']['trx_id'] = '';
        $this->request->data['Transaction']['auth_code'] = '';

        $amount = $this->request->data['Transaction']['payable_amount'];

        $alert = '<div class="alert alert-success"> ';

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();

            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {

                //individual_transaction_by_card
                $this->request->data['Transaction']['trx_id'] = $tresponse->getTransId();
                $this->request->data['Transaction']['auth_code'] = $tresponse->getAuthCode();
                $this->request->data['Transaction']['status'] = 'success';
                $id = $this->request->data['Transaction']['id'];
                $this->request->data['Transaction']['transaction_id'] = $id;

                unset($this->request->data['Transaction']['id']);
                //creatre transaction History 

                $this->Transaction->save($this->request->data['Transaction']);

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
                // check due amount 
//                $due=5;
                $due = $this->getDue($id);
                $credit = $this->getCredit($this->request->data['Transaction']['package_customer_id']);
                $totalDue = $due + $credit;
                if ($due > 0) {
                    $status = 'open';
                }
                unset($this->request->data['Transaction']['payable_amount']);
                $this->Transaction->id = $id;
                $this->Transaction->saveField("status", $status);

                $msg .='<li> Transaction successfull</li>';
                $tdata['Ticket'] = array('content' => "Transaction successfull <br> <b>Amount : </b>$amount <br> <b> payment Mode: </b> Card");
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
                $tresponse = $response->getTransactionResponse();
                $message = $response->getMessages();
                $message = $message->getMessage();
                $message = $message[0];
                $errorCode = $message->getCode();
                if ($errorCode == 'E00003') {
                    $errorMsg = 'Invalid Card number. Check Card Number, remove space or any special carachter inserted by mistkae <br> <b> Error Code: ' . $errorCode . '</b>';
                } else if ($errorCode == 'E00007') {
                    $errorMsg = 'Transaction failed due to Marchant Account credential changed. Please contact with administrator <br> <b> Error Code: ' . $errorCode . '</b>';
                } else {
                    $errors = $tresponse->getErrors();
                    $errors = $errors[0];
                    $errorMsg = $errors->getErrorText() . '<br> <b> Error Code: ' . $errorCode . '</b>';
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
        //$this->set(compact('msg'));
    }

    // Auto recurring start

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

//    Auto  recurring create invoice start
    public function processAutore() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Log');
        $today = date('Y-m-d');
        
//        $today_exp = date('m/y');       
//        $today_exp_str = strtotime($today_exp);       
//        pr($today_exp_str); exit;

        //card exp_date over 
        //exp_date less then present date
//        $sql = "SELECT * FROM package_customers WHERE package_customers.auto_r =  'yes'
//                AND package_customers.invoice_created =0 AND package_customers.r_form = '$today' AND (TIME(package_customers.exp_date)) < $today_exp_str";
//        $pcs_exp_date = $this->PackageCustomer->query($sql);
//
//        echo $this->PackageCustomer->getLastQuery();
//        
        //total auto recurring customers
        //exp_date greter then equal present date
        $sql = "SELECT count(id)as total FROM package_customers WHERE package_customers.auto_r =  'yes'
                AND package_customers.invoice_created =0 AND package_customers.r_form = '$today'";
        $pcs = $this->PackageCustomer->query($sql);
//                echo $this->PackageCustomer->getLastQuery();
        $total = $pcs[0][0]['total'];

        //total invoice created
        $sql = "SELECT count(package_customers.id)as total FROM transactions"
                . " LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id"
                . " WHERE transactions.auto_recurring = 1 AND package_customers.auto_recurring_failed = 0 "
                . "AND transactions.next_payment <= '$today' AND transactions.status = 'open'";
        $pcs_in = $this->Transaction->query($sql);
        $total_in = $pcs_in[0][0]['total'];

        //total invoice created (customers info)
        $sql = "SELECT * FROM transactions"
                . " LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id"
                . " WHERE transactions.auto_recurring = 1 AND package_customers.auto_recurring_failed = 0 "
                . "AND transactions.next_payment <= '$today' AND transactions.status = 'open'";
        
//        echo $sql;
        $pcs_c = $this->Transaction->query($sql);
        $this->Log->save($this->log_info()); // log information  
        $this->set(compact('total', 'total_in', 'pcs_c','pcs_exp_date'));
    }

    public function processAutoRecurring() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('AutoRecurring');
        $this->loadModel('Transactions');

        $today = date('Y-m-d');
        $today_exp = date('m/y');
//        $sql = "SELECT * FROM transactions
//                LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id               
//                WHERE package_customers.auto_r = 'yes' AND package_customers.invoice_created = 0 
//                AND package_customers.r_form = '$today'";
//         echo $sql; exit;
        if ($this->request->is('post') || $this->request->is('put')) {
//            $time = strtotime('11/17');
//            $newformat = date('Y-m-d', $time);

            $today = date('Y-m-d');
            $sql = "SELECT * FROM package_customers WHERE package_customers.auto_r =  'yes'
                AND package_customers.invoice_created =0 AND package_customers.r_form = '$today'";
//        $sql = "SELECT * FROM transactions
//                LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id               
//                WHERE package_customers.auto_r = 'yes' AND package_customers.invoice_created = 0 
//                AND package_customers.r_form = '$today'";
//         echo $sql; exit;
            $pcs = $this->PackageCustomer->query($sql);
//echo $this->packageCustomer->getLastQuery();
            $success = 0;
            $failure = 0;
//            exit;
            foreach ($pcs as $single) {
                $pc = $single['package_customers'];
                $duration = $pc['r_duration'];
                $rFrom = $pc['r_form'];
                $temp = date('Y-m-d', strtotime($rFrom . '-15  days'));
                $deadline = strtotime($temp);
                $temp = date('Y-m-d');
                $now = strtotime($temp);
//            if ($now >= $deadline) { // this is prior 15 days of payment date. So generate invoice 
                $data['Transaction'] = array(
                    'package_customer_id' => $pc['id'],
                    'note' => 'This Invoice is generated from system',
                    'discount' => 0,
                    'status' => 'open',
                    'next_payment' => $rFrom,
                    'auto_recurring' => 1,
                    'payable_amount' => $pc['payable_amount']
                );

                $this->generateInvoice($data);
                $this->PackageCustomer->create();
                $this->PackageCustomer->id = $pc['id'];
                $this->PackageCustomer->saveField('invoice_created', 1);
//            }
            }
        }
        $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Auto recurring invoice has been created </strong>
	</div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

    function generateInvoice($data = array()) {
        $this->loadModel('Transaction');
        $this->Transaction->create();
        $d = $this->Transaction->save($data);
    }

//    Auto recurring create invoice end

    function auto_recurring_invoice() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('AutoRecurring');
        $this->loadModel('Transactions');
// $sql = 'SELECT * FROM package_customers WHERE  LOWER(package_customers.auto_r) ="yes" AND package_customers.invoice_created = 0';
//$pcs = $this->PackageCustomer->query($sql);
        //$pcs = $this->PackageCustomer->find('all', array('conditions' => array('PackageCustomer.auto_r' => 'yes', 'PackageCustomer.invoice_created' => 0, 'PackageCustomer.invoice_created' => 0)));
        $today = date('Y-m-d');
        $sql = "SELECT * FROM package_customers WHERE package_customers.auto_r =  'yes'
                AND package_customers.invoice_created =0 AND package_customers.r_form = '$today'";
//        $sql = "SELECT * FROM transactions
//                LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id               
//                WHERE package_customers.auto_r = 'yes' AND package_customers.invoice_created = 0 
//                AND package_customers.r_form = '$today'";
//         echo $sql; exit;
        $pcs = $this->PackageCustomer->query($sql);
//echo $this->packageCustomer->getLastQuery();
        $success = 0;
        $failure = 0;

        foreach ($pcs as $single) {

            $pc = $single['package_customers'];
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
//            if ($now >= $deadline) { // this is prior 15 days of payment date. So generate invoice 
            $data['Transaction'] = array(
                'package_customer_id' => $pc['id'],
                'note' => 'This Invoice is generated from system',
                'discount' => 0,
                'status' => 'open',
                'next_payment' => $rFrom,
                'auto_recurring' => 1,
                'payable_amount' => $pc['payable_amount']
            );
//              
            $this->generateInvoice($data);
            $this->PackageCustomer->create();
            $this->PackageCustomer->id = $pc['id'];
            $this->PackageCustomer->saveField('invoice_created', 1);
//            }
        }
    }

    function auto_recurring_payment() {
        $this->loadModel('Transaction');
        $this->loadModel('Log');  
        $this->Log->save($this->log_info()); // log information
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

        $msg = '<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong> Auto recurring transaction has been Successful </strong>
	</div>';
        $this->Session->setFlash($msg);
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
        $card = $data;
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        //API Login ID
        $merchantAuthentication->setName("5Rx77cdF2EE"); // testing mode //5Rx77cdF2EE
//      $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
        //Current Transaction Key:
        $merchantAuthentication->setTransactionKey("8kL6269fdrR3m8Bp");  // testing mode //8kL6269fdrR3m8Bp
//      $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX      

        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $msg = '<ul>';
        $creditCard->setCardNumber($card['card_no']);

        $e_date = explode('/', $card['exp_date']);
        $exp_date = $e_date[0] . '-' . $e_date[1];
        $this->request->data['Transaction']['exp_date'] = $exp_date;
        $creditCard->setExpirationDate($exp_date);

        $creditCard->setcardCode($card['cvv_code']); //live
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //    Bill To
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($card['fname']);
        $billto->setLastName($card['lname']);
        //$billto->setCompany($card['company']);
        //$billto->setAddress("14 Main Street");
        //$billto->setAddress($card['address']);
        $billto->setCity($card['city']);
        $billto->setState($card['state']);
        $billto->setZip($card['zip_code']);
        //$billto->setCountry($card['country']);
        $billto->setphoneNumber($card['phone']);
        //$billto->setfaxNumber($card['fax']);

        $paymentprofile = new AnetAPI\CustomerPaymentProfileType();

        $paymentprofile->setCustomerType('individual');
        $paymentprofile->setBillTo($billto);
        $customerProfile = new AnetAPI\CreateCustomerPaymentProfileRequest();
        $customerProfile->setPaymentProfile($paymentprofile);

        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($card['payable_amount']); // to do set amount from form
        $transactionRequestType->setPayment($paymentOne);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);

        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
//        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        
      
        $this->request->data['Transaction']['error_msg'] = '';
        $this->request->data['Transaction']['status'] = '';
        $this->request->data['Transaction']['trx_id'] = '';
        $this->request->data['Transaction']['auth_code'] = '';
        $this->request->data['Transaction']['card_no'] = '';
        $this->request->data['Transaction']['zip_code'] = '';
        $amount = $card['payable_amount'];
        $cardno = $card['card_no'];
        $czip = $card['zip_code'];
        $alert = '<div class="alert alert-success"> ';

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $this->request->data['Transaction']['trx_id'] = $tresponse->getTransId();
                $this->request->data['Transaction']['auth_code'] = $tresponse->getAuthCode();

                $this->request->data['Transaction']['status'] = 'success';
                $id = $data['id'];
                $this->request->data['Transaction']['transaction_id'] = $id;
                $this->request->data['Transaction']['payable_amount'] = $amount;
                $this->request->data['Transaction']['card_no'] = $cardno;
                $this->request->data['Transaction']['zip_code'] = $czip;

//creatre transaction History 
                $this->Transaction->create();
                $this->Transaction->save($this->request->data['Transaction']);
                unset($this->request->data['Transaction']['transaction_id']);
                $status = 'close';
// check due amount 
                unset($card['payable_amount']);
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

                $r_from = date('Y-m-d', strtotime('+' . $card['duration'] . '  days'));
                $r_from = date('Y-m-' . $card['day'], strtotime("+" . $card['duration'] . " months", strtotime($card['from'])));
                $this->PackageCustomer->saveField('r_form', $r_from);
                $this->PackageCustomer->saveField('invoice_created', 0);
            } else {
                $alert = '<div class="alert alert-error"> ';
                $tresponse = $response->getTransactionResponse();
                $message = $response->getMessages();
                $message = $message->getMessage();
                $message = $message[0];
                $errorCode = $message->getCode();
                
                if ($errorCode == 'E00003') {
                    $errorMsg = 'This payment attempt was from auto recurring. Invalid Card number. Check Card Number, remove space or any special carachter inserted by mistkae <br> <b> Error Code: ' . $errorCode . '</b>';
                } else if ($errorCode == 'E00007') {
                    $errorMsg = 'This payment attempt was from auto recurring. Transaction failed due to Marchant Account credential changed. Please contact with administrator <br> <b> Error Code: ' . $errorCode . '</b>';
                } else if ($errorCode == 'E00027') {
                    $errorMsg = 'The credit card has expired.<br>';
                } else if ($errorCode == 'I00001') {
                    $errorMsg = 'Please contact with customer for leatest card information.<br>';
                } else {
                    $errorMsg = '<br> <b> Error Code: ' . $errorCode . '</b>';
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
    }

}

?>