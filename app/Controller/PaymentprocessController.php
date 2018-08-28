<?php



//require_once(APP . 'Vendor' . DS . 'class.upload.php');
class PaymentsController extends AppController {
    var $layout = 'admin';
    // public $components = array('Auth');
    public function isAuthorized($user = null) {
        $sidebar = $user['Role']['name'];
        $this->set(compact('sidebar'));
        return true;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('process');

        $this->img_config = array(
            'check_image' => array(
                'image_ratio_crop' => false,
            ),
            'parent_dir' => 'check_images',
            'target_path' => array(
                'check_image' => WWW_ROOT . 'check_images' . DS
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
//        pr($img); 
//         echo $type;
//         exit;
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
        $sql = "SELECT * FROM transactions WHERE (transactions.status ='success' OR transactions.status ='close'  OR transactions.status ='update' OR transactions.status ='auto_recurring') AND transactions.pay_mode='card' AND transactions.package_customer_id = $customer_id ORDER BY transactions.id DESC LIMIT 1";
        $temp = $this->Transaction->query($sql);
        $yyyy = 0;
        $mm = -1;
        $latestcardInfo = array('card_no' => '', 'exp_date' => array('year' => 0, 'month' => 0), 'fname' => '', 'lname' => '', 'cvv_code' => '', 'zip_code' => '', 'trx_id' => '');
        if (count($temp)) {
            $date = explode('/', $temp[0]['transactions']['exp_date']);
            if (count($date) != 2) {
                $date = explode('-', $temp[0]['transactions']['exp_date']);
            }
            // pr($date); exit;
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
        $data = $this->Transaction->findById($trans_id);
        $latestcardInfo['card_no'] = $this->formatCardNumber($latestcardInfo['card_no']);
        $this->request->data['Transaction'] = $latestcardInfo;

        $this->request->data['Transaction']['id'] = $data['Transaction']['id'];
        $this->request->data['Transaction']['payable_amount'] = $data['Transaction']['payable_amount'] - $paid;
        $this->set('customer_info');
    }

    public function individual_transaction_by_card() {
        $this->loadModel('Transaction');
        $this->loadModel('Track');
        $this->loadModel('Ticket');
        if (strpos($this->request->data['Transaction']['card_no'], 'X') !== false) {
            //Card number is not provided. So fetch previous card number
            //  $temp = $this->Transaction->findById($this->request->data['Transaction']['id']);
            $latestcardInfo = $this->getLastCardInfo($this->request->data['Transaction']['package_customer_id']);
            $this->request->data['Transaction']['card_no'] = trim($latestcardInfo['card_no']);
        }
        //  pr($temp);
        // exit;
        //  pr($this->request->data['Transaction']);
        //  exit;
        // PROCESS PAYMENT
        // Common setup for API credentials  
        $loggedUser = $this->Auth->user();
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        //$merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
        //$merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX
        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $msg = '<ul>';
        //$this->request->data['Transaction']['id'] = $cid;
        $card = $this->request->data['Transaction'];
        $cid = $this->request->data['Transaction']['package_customer_id'];
        //      pr($card);
//        exit;
        $creditCard->setCardNumber($card['card_no']);
        $exp_date = $card['exp_date']['month'] . '-' . $card['exp_date']['year'];
        $this->request->data['Transaction']['exp_date'] = $exp_date;
        // pr($this->request->data); exit;
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
        $billto->setCompany($card['company']);
        //$billto->setAddress("14 Main Street");
        $billto->setAddress($card['address']);
        $billto->setCity($card['city']);
        $billto->setState($card['state']);
        $billto->setZip($card['zip_code']);
        $billto->setCountry($card['country']);
        $billto->setphoneNumber($card['phone']);
        $billto->setfaxNumber($card['fax']);

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
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);


        $this->request->data['Transaction']['error_msg'] = '';
        $this->request->data['Transaction']['status'] = '';
        $this->request->data['Transaction']['trx_id'] = '';
        $this->request->data['Transaction']['auth_code'] = '';
        $amount = $this->request->data['Transaction']['payable_amount'];
        $alert = '<div class="alert alert-success"> ';

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $this->request->data['Transaction']['trx_id'] = $tresponse->getTransId();
                $this->request->data['Transaction']['auth_code'] = $tresponse->getAuthCode();
                $this->request->data['Transaction']['status'] = 'success';
                $id = $this->request->data['Transaction']['id'];
                $this->request->data['Transaction']['transaction_id'] = $id;
                //  pr($this->request->data['Transaction']); exit;
                unset($this->request->data['Transaction']['id']);
                //creatre transaction History 

                $this->Transaction->save($this->request->data['Transaction']);
                unset($this->request->data['Transaction']['transaction_id']);
                $status = 'close';
                // check due amount 
                $due = $this->getDue($id);
                if ($due > 0) {
                    $status = 'open';
                }
                unset($this->request->data['Transaction']['payable_amount']);
                $this->Transaction->id = $id;
                $this->Transaction->saveField("status", $status);

                $msg .='<li> Transaction   successfull</li>';
                $tdata['Ticket'] = array('content' => "Transaction successfull <br> <b>Amount : </b>$amount <br> <b> payment Mode: </b> Card");
                $tickect = $this->Ticket->save($tdata); // Data save in Ticket
                $trackData['Track'] = array(
                    'package_customer_id' => $cid,
                    'ticket_id' => $tickect['Ticket']['id'],
                    //'status' => 'closed',
                    'forwarded_by' => $loggedUser['id']
                );

                $this->Track->save($trackData);
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

    public function individual_auto_recurring($data) {
        foreach ($data as $key => $value):
            $data[$key] = trim($value);
        endforeach;
        //  pr($data); exit;
        //Get ID and Input amount from edit_customer page
        $cid = $data['cid'];
        // pr($this->request->data); exit;
        //pr($this->request->data['Transaction']);
        $this->layout = 'ajax';
        // Common setup for API credentials  
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
          $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
//        $merchantAuthentication->setName("7zKH4b45"); //42UHbr9Qa9B live mode
          $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
//        $merchantAuthentication->setTransactionKey("738QpWvHH4vS59vY"); // live mode 7UBSq68ncs65p8QX
        $refId = 'ref' . time();
// Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $this->loadModel('PackageCustomer');
        $this->loadModel('Transaction');
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        // $loggedUser = $this->Auth->user();
        $transaction['user_id'] = 0;
        $creditCard->setCardNumber($data['card_no']);
        $creditCard->setExpirationDate($data['exp_date']);
        //    $creditCard->setCardNumber("4117733943147221"); // live
        // $creditCard->setExpirationDate("07-2019"); //live
        $creditCard->setcardCode($data['cvv_code']); //live
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        //    Bill To
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName($data['fname']);
        $billto->setLastName($data['lname']);
        $billto->setCompany($data['company']);
        //$billto->setAddress("14 Main Street");
        $billto->setAddress($data['address']);
        $billto->setCity($data['city']);
        $billto->setState($data['state']);
        $billto->setZip($data['zip_code']);
        $billto->setCountry($data['country']);
        $billto->setphoneNumber($data['phone']);
        $billto->setfaxNumber($data['fax']);

        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount($data['payable_amount']); // to do set amount from form
        $transactionRequestType->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
         $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
//        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $transaction = array();
        $transaction['error_msg'] = '';
        $transaction['status'] = '';
        $transaction['trx_id'] = '';
        $transaction['auth_code'] = '';
        $transaction['package_customer_id'] = $data['cid'];
        $transaction['fname'] = $data['fname'];
        $transaction['lname'] = $data['lname'];
        $transaction['exp_date'] = $data['exp_date'];
        $transaction['address'] = $data['address'];
        $transaction['city'] = $data['city'];
        $transaction['state'] = $data['state'];
        $transaction['zip_code'] = $data['zip_code'];
        $transaction['phone'] = $data['phone'];
        $transaction['payable_amount'] = $data['payable_amount'];
        $transaction['card_no'] = $data['card_no'];
        $transaction['cvv_code'] = $data['cvv_code'];
        $transaction['fax'] = $data['fax'];
        $transaction['auto_recurring'] = 1;
        $amount = $data['payable_amount'];
        $msg = '<ul>';
        //  pr($response);
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                //  echo 'here'; exit;
                $transaction['trx_id'] = $tresponse->getTransId();
                $transaction['auth_code'] = $tresponse->getAuthCode();
                $transaction['status'] = 'success';
                $id = $data['id'];
                $transaction['transaction_id'] = $id;
                //  pr($transaction); exit;
                //creatre transaction History 
                $this->Transaction->create();
                $this->Transaction->save($transaction);
                unset($transaction['transaction_id']);
                $status = 'close';
                // check due amount 
                unset($transaction['payable_amount']);
                $this->Transaction->id = $id;
                //$this->Transaction->create();
                $this->Transaction->saveField("status", $status);

                $msg .='<li> Transaction successfull by auto recurring</li>';
                $tdata['Ticket'] = array('content' => "Transaction successfull by auto recurring <br> <b>Amount : </b>$amount <br> <b> payment Mode: </b> Card", 'status' => 'solved');
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
                } else {
                    $errors = $tresponse->getErrors();
                    $errors = $errors[0];
                    $errorMsg = $errors->getErrorText() . '<br> <b> Error Code: ' . $errorCode . '</b>';
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
        }
        //$this->set(compact('msg'));
    }

    function auto_recurring_invoice() {
        $this->loadModel('PackageCustomer');
        $this->loadModel('AutoRecurring');
        $pcs = $this->PackageCustomer->find('all', array('conditions' => array('auto_r' => 'yes', 'invoice_created' => 0)));
        // pr($pcs); exit;
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
            $deadline = strtotime($temp);
            $temp = date('Y-m-d');
            $now = strtotime($temp);
            if ($now >= $deadline) { // this is prior 15 days of payment date. So generate invoice 
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
            }
        }
    }

    function auto_recurring_payment() {
        $this->loadModel('Transaction');
        //  $this->loadModel('PackageCustomer');
        $today = date('Y-m-d');
        $sql = "SELECT * FROM transactions"
                . " LEFT JOIN package_customers ON transactions.package_customer_id = package_customers.id"
                . " WHERE transactions.auto_recurring = 1 AND transactions.next_payment <= '$today' AND transactions.status = 'open' LIMIT 20";

        // $data = $this->Transaction->find('all', array('conditions' => array('auto_recurring' => 1, 'next_payment' => $today)));
        $data = $this->Transaction->query($sql);
        //  pr($data);
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
                'duration' => $pc['r_duration']
            );

            $this->individual_auto_recurring($data);
        }
    }

    function message() {
        
    }

    function refundTransaction() {
        $loggedUser = $this->Auth->user();
        //  pr($this->request->data['Transaction']);
        //    exit;
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $loggedUser = $this->Auth->user();
        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        // $merchantAuthentication->setName("95x9PuD6b2"); // testing mode
        $merchantAuthentication->setName("42UHbr9Qa9B"); // live mode
        // $merchantAuthentication->setTransactionKey("547z56Vcbs3Nz9R9");  // testing mode
        $merchantAuthentication->setTransactionKey("6468X36RkrKGm3k6"); // live mode
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
//        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $msg = '';

        $data4transaction['Transaction']['exp_date'] = $this->request->data['Transaction']['exp_date'];

        $data4transaction['Transaction']['card_no'] = $this->request->data['Transaction']['card_no'];
        $data4transaction['Transaction']['user_id'] = $loggedUser['id'];
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            //pr($tresponse); exit;
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
                //  pr($tdata['Ticket']);exit;
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
//        pr($this->request->data); exit;
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

        $this->request->data['Transaction']['status'] = 'close';
        // check due amount 
        $due = $this->getDue($id);
        echo 'Due : '.$due; exit;
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;
//         pr('here'); exit;
        $this->Transaction->save($this->request->data['Transaction']);
        // generate Ticket
        $tdata['Ticket'] = array('content' => "Transaction successfull<br> <b> Amount : </b> $amount <br> <b> Payment mode :</b> Check", 'status' => 'solved');
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
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    public function individual_transaction_by_morder() {
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

        // pr($this->request->data['Transaction']); exit;
        //creatre transaction History 
        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);

        $this->request->data['Transaction']['status'] = 'close';
        // check due amount 
        $due = $this->getDue($id);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;
        $this->Transaction->save($this->request->data['Transaction']);
        // generate Ticket
        $tdata['Ticket'] = array('content' => "Transaction successfull<br> <b> Amount : </b> $amount <br> <b> Payment mode: </b> Money Order", 'status' => 'solved');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'closed',
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

        $this->request->data['Transaction']['status'] = 'close';

        // pr($this->request->data['Transaction']); exit;
        //creatre transaction History 
        $this->Transaction->save($this->request->data['Transaction']);
        unset($this->request->data['Transaction']['transaction_id']);

        $this->request->data['Transaction']['status'] = 'close';
        // check due amount 
        $due = $this->getDue($id);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;

        $this->Transaction->save($this->request->data['Transaction']);
        // generate Ticket
        $tdata['Ticket'] = array('content' => "Transaction successfull<br> <b> Amount : </b> $amount <br> <b> Payment Mode : </b> Online Bill", 'status' => 'solved');
        $tickect = $this->Ticket->save($tdata); // Data save in Ticket

        $trackData['Track'] = array(
            'package_customer_id' => $this->request->data['Transaction']['package_customer_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => 'closed',
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData);
        // End generate Ticket

        $this->Transaction->id = $this->request->data['Transaction']['id'];

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


        $this->request->data['Transaction']['status'] = 'close';
        // check due amount 
        $due = $this->getDue($id);
        if ($due > 0) {
            $this->request->data['Transaction']['status'] = 'open';
        }
        $amount = $this->request->data['Transaction']['payable_amount'];
        unset($this->request->data['Transaction']['payable_amount']);
        $this->Transaction->id = $id;

//        pr($this->request->data['Transaction']); exit;
        $this->Transaction->save($this->request->data['Transaction']);
        // generate Ticket
        $tdata['Ticket'] = array('content' => "Transaction successfull<br> <b> Amount : </b> $amount <br> <b> Payment Mode :</b> Cash", 'status' => 'solved');
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
                        <strong> Payment record saved successfully</strong>
                        </div>';
        $this->Session->setFlash($transactionMsg);
        return $this->redirect($this->referer());
    }

    function custom_payment() {
        $this->loadModel('Transaction');
        $this->loadModel('Role');
        $this->loadModel('User');

        if ($this->request->is('post')) {
            $this->Transaction->set($this->request->data);
            if ($this->Transaction->validates()) {
                $temp = explode('/', $this->request->data['Transaction']['created']);
                $this->request->data['Transaction']['created'] = $temp[2] . '-' . $temp[0] . '-' . $temp[1] . ' 00:00:00';
                // pr($this->request->data); exit;
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
        $this->request->data['Transaction']['created'] = $this->getFormatedDate($this->request->data['Transaction']['created']) . ' 00:00:00';
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
        // pr($this->request->data['Transaction']); exit;
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
//         pr('here'); exit;
        $this->Transaction->saveField('status', $status);

        // generate Ticket
        $tdata['Ticket'] = array('content' => "This is paid invoice.Paid invoice record saved successfully<br> <b> Amount : </b> $amount <br> <b> Payment mode :</b> Card", 'status' => 'solved');
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

    function adjustmentMemo($id = null) {
        $this->loadModel('PackageCustomer');
        $this->PackageCustomer->set($this->request->data);
        $this->PackageCustomer->id = $id;
       
        $this->PackageCustomer->id = $this->request->data['PackageCustomer']['cid'];
//         pr($this->request->data); exit;
        $this->PackageCustomer->save($this->request->data['PackageCustomer']);
        $msg = '<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Succeesfully insert data </strong></div>';
        $this->Session->setFlash($msg);
        return $this->redirect($this->referer());
    }

}

?>