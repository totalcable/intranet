<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('ReportsController', 'Controller');
App::uses('Mylib', 'Lib');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email', //Default is 'username' in the userModel
                        'password' => 'password'  //Default is 'password' in the userModel
                    ),
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha256'
                    )
                )
            )
        )
    );
    public $per_page = 10;

    public function beforeFilter() {

        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('PackageCustomer');
        if (in_array($this->params['controller'], array('rest_payments'))) {
            // For RESTful web service requests, we check the name of our contoller
            $this->Auth->allow();
            // this line should always be there to ensure that all rest calls are secure
            /* $this->Security->requireSecure(); */
            $this->Security->unlockedActions = array('edit', 'delete', 'add', 'view', 'process');
        } else {
            // setup out Auth
            $this->Auth->allow();
        }
        // save last visited url
        $url = Router::url(NULL, true); //complete url
        if (!preg_match('/login|logout|isLooged_in/i', $url)) {
            $this->Session->write('lastUrl', $url);
        }
        $this->set('baseUrl', Router::url('/', true));
        $this->Auth->allow('index', 'logo');
        $admin = $this->Auth->user();
        if (isset($admin['Role']['name'])) {
            $sidebar = $admin['Role']['name'];
            $this->set(compact('sidebar'));
        }
        $loggedUser = $this->Auth->user();
        $this->set('loggedUser', $loggedUser['name']);

        //  $this->sendReport();
        // echo 'works'; exit;
        //   $loggedUserpic = $this->Auth->user();       
        //  $this->set('loggedUserpic', $loggedUser['picture']);
        // Function to get the client IP address
        //In-progress
        $temp = $this->Ticket->query("SELECT COUNT(tr.id) as total FROM tracks tr 
                LEFT JOIN tickets t ON tr.ticket_id = t.id 
                LEFT JOIN users fb ON tr.forwarded_by = fb.id 
                LEFT JOIN roles fd ON tr.role_id = fd.id 
                LEFT JOIN users fi ON tr.user_id = fi.id 
                LEFT JOIN issues i ON tr.issue_id = i.id 
                LEFT join package_customers pc on tr.package_customer_id = pc.id 
                Where (t.status = 'open' AND tr.status != 'outbound' AND tr.issue_id != 22 AND tr.issue_id != 172 AND tr.issue_id != 23 AND tr.issue_id !=181 AND tr.issue_id !=150 AND tr.issue_id !=167 AND tr.issue_id !=149 AND tr.issue_id !=147 AND tr.issue_id !=28 AND tr.issue_id !=20 AND tr.issue_id !=31 AND tr.issue_id !=30 AND tr.issue_id !=24 AND tr.issue_id !=21 AND tr.issue_id !=27 AND tr.issue_id !=29 AND tr.issue_id !=89) AND  (t.content NOT LIKE '%be expired%' AND t.content NOT LIKE '%Error Code%' AND t.content NOT LIKE '%successful%' AND t.content NOT LIKE '%declined%' AND t.content NOT LIKE '%leatest card information%')");
        $total_inprogress = $temp[0][0]['total'];
        
        //Refund bonus
        $temp = $this->Ticket->query("SELECT COUNT(tr.id) as total FROM tracks tr 
                LEFT JOIN tickets t ON tr.ticket_id = t.id 
                LEFT JOIN users fb ON tr.forwarded_by = fb.id 
                LEFT JOIN roles fd ON tr.role_id = fd.id 
                LEFT JOIN users fi ON tr.user_id = fi.id 
                LEFT JOIN issues i ON tr.issue_id = i.id 
                LEFT join package_customers pc on tr.package_customer_id = pc.id 
                Where (t.status = 'open' AND tr.status != 'outbound')AND (tr.issue_id=22 OR tr.issue_id=172 OR tr.issue_id=23)");
        $total_refund_bonus = $temp[0][0]['total'];

        //Successful
        $temp = $this->Ticket->query("SELECT COUNT( DISTINCT tr.ticket_id ) AS total FROM tracks tr LEFT JOIN tickets t ON tr.ticket_id = t.id 
        where tr.issue_id = 0 AND  t.status = 'open' AND t.content LIKE '%successfull%'");
        $total_successful = $temp[0][0]['total'];

        //Declined
        $temp = $this->Ticket->query("SELECT COUNT(tr.ticket_id ) AS total FROM tracks tr LEFT JOIN tickets t ON tr.ticket_id = t.id 
        where tr.issue_id = 0 AND t.status ='open' AND t.content NOT LIKE ('%successful%')");
        $total_declined = $temp[0][0]['total'];

        //Declined S Admin
        $sql = "SELECT  COUNT(DISTINCT pc.id) as total FROM package_customers pc 
                inner join tracks tr on tr.package_customer_id = pc.id 
                inner join tickets t on t.id = tr.ticket_id
                where pc.auto_r = 'yes' AND t.status = 'open' 
                AND (t.content LIKE '%decline%' 
                OR t.content LIKE '%mismatch%' 
                OR t.content LIKE '%Card expired%' 
                OR t.content LIKE '%Duplicate%' 
                OR t.content LIKE '%due to Invalid%')";
        $temp = $this->Track->query($sql);
        $total_declined_sadmin = $temp[0][0]['total'];

        // Admin invoice created data modify
        $sql = "SELECT  COUNT(pc.id) as total FROM  package_customers pc WHERE invoice_created =1 AND auto_r = 'yes'";
        $temp = $this->PackageCustomer->query($sql);
        $invoice_created = $temp[0][0]['total'];

        //Total cancel request customers
        $conditions = "";
        $p_date = '1999/01/01';
        $conditions .="pc.cancelled_date >='" . $p_date . "'";
        $total = $this->PackageCustomer->query("SELECT COUNT( pc.id ) AS total_c FROM package_customers pc 
            
            WHERE pc.status = 'Request to cancel' AND $conditions");
        $total_cancel_request = $total[0][0]['total_c'];
//            pr($total_cancel_request); exit;
//            
//            
        //Total hold request customers
        $conditions = "";
        $p_date = '01/01/1999';
        $conditions .="pc.hold_date >='" . $p_date . "'";
        $total = $this->PackageCustomer->query("SELECT COUNT( pc.id ) AS total_c FROM package_customers pc            
            WHERE pc.status =  'Request to hold' AND $conditions");
        $total_hold_request = $total[0][0]['total_c'];
//            pr($total_cancel_request); exit
//            
//            //Total unhold request customers
        $conditions = "";
        $p_date = '01/01/1999';
        $conditions .="pc.unhold_date >='" . $p_date . "'";
        $total = $this->PackageCustomer->query("SELECT COUNT( pc.id ) AS total_c FROM package_customers pc             
            WHERE pc.status ='Request to unhold' AND $conditions");
        $total_unhold_request = $total[0][0]['total_c'];

        //Total reconnection customers
        $total = $this->PackageCustomer->query("SELECT COUNT( pc.id ) AS total_c FROM package_customers pc             
            WHERE pc.status =  'Request to reconnection'");
        $total_reconnection_request = $total[0][0]['total_c'];

        //Next recurring start
        //Next month recurring 

        $date_next_month = date('Y-m-d', strtotime('first day of next month'));
        $total = $this->PackageCustomer->query("SELECT COUNT(id)as total_n_c FROM package_customers WHERE next_recurring = 'yes' AND (next_r_date <= '$date_next_month' AND next_r_date != '0000-00-00')");
        $total_month_cus = $total[0][0]['total_n_c'];

        //Next recurring total
        $total_c = $this->PackageCustomer->query("SELECT COUNT(id)as total_ FROM package_customers WHERE next_recurring = 'yes' AND next_r_date != '0000-00-00'");
        $total_cus_r = $total_c[0][0]['total_'];
        //Next recurring end

        //login request total agent
        $total_u = $this->User->query("SELECT COUNT(id)as total_ FROM users WHERE log_status = 'request'");       
        $total_user = $total_u[0][0]['total_'];
       
        $total_u_d = $this->User->query("SELECT COUNT(id)as total_ FROM users WHERE log_status = 'request' AND role_id = 15");       
        $total_u_developer = $total_u_d[0][0]['total_'];
//         pr($total_user); exit;
        //Next recurring end

        $this->set(compact('total_refund_bonus','total_u_developer','total_user','total_month_cus', 'total_cus_r', 'total_reconnection_request', 'total_unhold_request', 'total_hold_request', 'total_cancel_request', 'total_successful', 'total_inprogress', 'total_declined', 'total_declined_sadmin', 'invoice_created'));
    }

    function create_ticket($data = array()) {
        $loggedUser = $this->Auth->user();
        $this->loadModel('Ticket');
        $this->loadModel('Track');
        $this->loadModel('Issue');
        $this->Ticket->create();
        $tickect = $this->Ticket->save($data); // Data save in Ticket
        $trackData['Track'] = array(
            'issue_id' => $data['issue_id'],
            'package_customer_id' => $data['customer_id'],
            'user_id' => $data['user_id'],
            'role_id' => $data['role_id'],
            'issue_id' => $data['issue_id'],
            'ticket_id' => $tickect['Ticket']['id'],
            'status' => $data['status'],
            'forwarded_by' => $loggedUser['id']
        );
        $this->Track->save($trackData); // Data save in Track
    }

    function getFormatedDate($date = null) {
        $temp = explode('/', $date);
        if (count($temp) > 1) {
            return $temp[2] . '-' . $temp[0] . '-' . $temp[1];
        }
        return $date;
    }

    function minus15() {
        $date = date('Y-m-d', strtotime('first day of next month'));
        $days_ago = date('Y-m-d', strtotime('-15 days', strtotime($date)));
        return $days_ago;
    }

    function loadFooter() {
        $this->loadModel('Footer');
        $footer = $this->Footer->find('all');
        $this->set(compact('footer'));
    }

    function loadLeftMenu() {
        $this->loadModel('Level');
        $options = array(
            'fields' => array('Level.name', 'Level.id', 'subjects.name', 'subjects.id', 'chapters.name', 'chapters.id'),
            'joins' => array('LEFT JOIN `subjects`  ON `Level`.`id` = `subjects`.`level_id` 
            LEFT JOIN `chapters`  ON `subjects`.`id` = `chapters`.`subject_id`       
                '),
            'conditions' => array('LOWER(Level.name)' => strtolower($this->request->params['action']))
        );

        $menus = $this->Level->find('all', $options);
        $filteredMenu = array();
        $unique = array();

        $index = 0;
        $subjectNo = 0;
        foreach ($menus as $key => $menu) {
            $level = $menu['Level']['id'];
            $subject = $menu['subjects']['id'];
            if (isset($unique[$level])) {
                if (isset($unique[$subject])) {
                    if (!empty($menu['chapters']['name'])) {
                        $temp = array('name' => $menu['chapters']['name'], 'chapter_id' => $menu['chapters']['id'], 'level_id' => $level, 'subject_id' => $subject);
                        $filteredMenu[$index]['subject'][$subjectNo]['chapter'][] = $temp;
                    }
                } else {
                    if ($key != 0)
                        $subjectNo++;
                    if (!empty($menu['chapters']['name'])) {
                        $temp = array('name' => $menu['subjects']['name']);
                        $filteredMenu[$index]['subject'][$subjectNo] = $temp;
                        $temp = array('name' => $menu['chapters']['name'], 'chapter_id' => $menu['chapters']['id'], 'level_id' => $level, 'subject_id' => $subject);
                        $filteredMenu[$index]['subject'][$subjectNo]['chapter'][] = $temp;
                    }
                }
            } else {

                if ($key != 0)
                    $index++;
                $unique[$level] = 'set';
                $temp = array('name' => $menu['Level']['name']);
                $filteredMenu[$index]['level'] = $temp;
                if (!empty($menu['subjects']['name'])) {
                    $temp = array('name' => $menu['subjects']['name']);
                    $filteredMenu[$index]['subject'][$subjectNo] = $temp;
                }


                if (!empty($menu['chapters']['name'])) {
                    $temp = array('name' => $menu['chapters']['name'], 'chapter_id' => $menu['chapters']['id'], 'level_id' => $level, 'subject_id' => $subject);
                    $filteredMenu[$index]['subject'][$subjectNo]['chapter'][] = $temp;
                }
            }
        }
        if (count($filteredMenu) > 0) {
            $leftMenu = $filteredMenu[0];
            $this->set(compact('leftMenu'));
        }

        //echo $this->Level->getLastQuery(); 
        //pr( $filteredMenu); exit;    
    }

    function pr($input = null) {
        echo '<pre>';
        print_r($input);
        echo '</pre>';
    }

    function generateError($input = null) {
        $output = '';
        if (is_array($input)) {
            $output = '<ul>';
            foreach ($input as $single) {
                foreach ($single as $value) {
                    $output.='<li>' . $value . '</li>';
                }
            }
            $output.='</ul>';
        } else {
            $output = $input;
        }

        $output = '<div class="alert alert-danger">
		' . $output . '<strong> Change these things and try again. </strong> </div>';
        return $output;
    }

    function humanTiming($input = null) {
        $time = strtotime($input);
        $time = time() - $time; // to get the time since that moment

        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit)
                continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '') . ' ago';
        }
    }

    public function getYM() {
        $cy = date('Y');
        $cm = date('m');
        $y = array();
        $n = 0;
        for ($i = $cy; $n < 40; $i++) {
            $y[$i] = $i;
            $n++;
        }
        $return['year'] = $y;
        $return['month'] = array(
            '01' => '01',
            '02' => '02',
            '03' => '03',
            '04' => '04',
            '05' => '05',
            '06' => '06',
            '07' => '07',
            '08' => '08',
            '09' => '09',
            '10' => '10',
            '11' => '11',
            '12' => '12'
        );
        return $return;
    }

    function getAllTickectsByCustomer($pcid) {
        $this->loadModel('Track');
        $this->loadModel('User');
        $this->loadModel('Role');
//        $tickets = $this->Track->query("SELECT * FROM tracks tr 
//                    inner join tickets t on tr.ticket_id = t.id
//                    inner join users fb on tr.forwarded_by = fb.id
//                    inner join roles r on  tr.role_id = r.id
//                    inner join users ft on  tr.user_id = ft.id order by tr.created desc");




        $tickets = $this->Track->query("SELECT * FROM tracks tr
                        left JOIN tickets t ON tr.ticket_id = t.id
                        left JOIN users fb ON tr.forwarded_by = fb.id
                        left JOIN roles fd ON tr.role_id = fd.id  
                        left JOIN users fi ON tr.user_id = fi.id
                        left JOIN issues i ON tr.issue_id = i.id
                        left join package_customers pc on tr.package_customer_id = pc.id
                        WHERE tr.package_customer_id =" . $pcid . " ORDER BY t.id DESC");

        $filteredTicket = array();
        $unique = array();
        $index = 0;
        //   pr($tickets); exit;
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
        // pr($data); exit;

        $users = $this->User->find('list', array('fields' => array('id', 'name',), 'order' => array('User.name' => 'ASC')));
        $roles = $this->Role->find('list', array('fields' => array('id', 'name',), 'order' => array('Role.name' => 'ASC')));
        $return['data'] = $data;
        $return['users'] = $users;
        $return['roles'] = $roles;
//        pr($return); exit;
        return $return;
    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

    function generateInvoice($data = array()) {
        $this->loadModel('Transaction');
        $this->Transaction->create();
        $d = $this->Transaction->save($data);
    }

    function formatCardNumber($card) {
        $digits = strlen($card);
        $last4 = substr($card, -4);
        $fill = '';
        for ($i = 0; $i < $digits - 4; $i++) {
            $fill .='X';
        }
        return $fill . $last4;
    }

    function log_info() {
        $this->loadModel('Log');
        $loggedUser = $this->Auth->user();
//        pr($loggedUser['name']); exit;
        //pc , ip and date time collect
        $myIp = getHostByName(php_uname('n'));
        $pc = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $date = date("Y-m-d");
        $pc_info = '<b>PC IP:</b> '. $myIp . '<br>' . 
                '<b>PC Name:</b> '.$pc . 
                '<br>' .'<b>Date:</b> '. $date;

        $logData['Log'] = array(
            'user_id' => $loggedUser['id'],
            'role_id' => $loggedUser['Role']['id'],
            'class_name' => $this->request->params['controller'],
            'function_name' => $this->request->params['action'],
            'ip' => $myIp,
            'pc_name' => $pc,
            'insert_date' => $date,
//            'pc_id' => $pc_info
        );
//        pr($logData); exit;
        return $logData['Log'];
    }

    function getSubscriptionNo($daterange, $package, $duration = 0) {
        $this->loadModel('Transaction');
        //1 month total packages
        $sql1monthp = "SELECT COUNT(ps.name) as total1monthp FROM transactions tr
                left join package_customers pc on pc.id = tr.package_customer_id 
            left join psettings ps on ps.id = pc.psetting_id 
            LEFT JOIN packages p ON p.id = ps.package_id 
            WHERE $daterange AND LOWER(ps.name) LIKE '%$package%'";
        //  echo $sql1monthp; exit;
        $sql1monthp = $this->Transaction->query($sql1monthp);
//            pr($sql1monthp); exit;
        $sql1monthp1 = $sql1monthp[0][0]['total1monthp'];
        $sql1monthp = "SELECT COUNT(cp.id) as total1monthp FROM transactions tr
                left join package_customers pc on pc.id = tr.package_customer_id 
            left join custom_packages cp on cp.id = pc.custom_package_id 
            WHERE $daterange AND cp.duration = $duration";
        $sql1monthp = $this->Transaction->query($sql1monthp);
//            pr($sql1monthp); exit;
        $sql1monthp2 = $sql1monthp[0][0]['total1monthp'];

        return $sql1monthp1 + $sql1monthp2;
    }

    function removeEmptyElement($data = array()) {
        foreach ($data as $index => $single) {
            if (empty($single)) {
                unset($data[$index]);
            }
        }
        return $data;
    }

    function sendEmail($emailInfo = array()) {

        $from = $emailInfo['from']; //'info@totalitsolution.com';
        $title = $emailInfo['title']; //'Report';
        $subject = $emailInfo['subject']; // "Reseller Registration";
        $to = $emailInfo['to']; //array('.com');
        $total = $emailInfo['content'];
        $date = $emailInfo['date'];
//        pr($tb); exit;
        $Email = new CakeEmail('default');
        $Email->template($emailInfo['template'], null)
                ->emailFormat('html')
                ->from(array($from => $title))
//                ->attachments(array(
//                    array(
////<img src="../../assets/admin/pages/media/email/social_twitter.png" alt="social icon">
//                        'file' => ROOT . '/app/webroot/media/twitter.png',
//                        'mimetype' => 'image',
//                        'contentId' => 'twitterIcon'
//                    ),
//                    array(
/////assets/admin/pages/media/email/social_facebook.png
//                        'file' => ROOT . '/app/webroot/media/facebook.png',
//                        'mimetype' => 'image/png',
//                        'contentId' => 'fbIcon'
//                    ),
//                    array(
//                        'file' => ROOT . '/app/webroot/media/logo-corp-red.png',
//                        'mimetype' => 'image',
//                        'contentId' => 'logo'
//                    )
//                ))
                ->viewVars(compact('total', 'date'))
                ->to($to)
                ->subject($subject);

        try {
            $Email->send();
            return true;
        } catch (SocketException $e) {
            return false;
        }
    }

    function sendReport() {
        $report = new ReportsController();
        $end = date('Y-m-d');
        $start = date('Y-m-d', strtotime($end . ' -1 day'));

        $tbhead = $start . ' To ' . $end;
//        pr($tbhead); exit;
// echo $start.' to '. $end;

        $total['sales_query'] = $report->getTotalSalesQuery($start, $end);
        // $total[0] = $total['done'] + $total['ready'];
        // $total['installation'] = $report->getTotalInstallation();
        $total['hold'] = $report->getTotalHold($start, $end);
        $total['unhold'] = $report->getTotalUnhold($start, $end);
        $total['reconnection'] = $report->getTotalReconnection($start, $end);
        $total['done'] = $report->getTotalDone($start, $end);

//            $total['ready'] = $report->getTotalNewordertaken();
//            $total['servicecancel'] = $report->getTotalFullServiceCancel();
//            $total['cancelduebill'] = $report->getTotalCancelDueBill();

        $total['cardinfotaken'] = $report->getTotalCardinfotaken($start, $end);
        $total['check_send'] = $report->getTotalCallBySatatus('check send', $start, $end);
        $total['vod'] = $report->getTotalCallBySatatus('vod', $start, $end);
        $total['interruption'] = $report->getTotalCallBySatatus('service interruption', $start, $end);
        $total['cancel'] = $report->getTotalCallBySatatus('service cancel', $start, $end);
        $total['cancel_from_da'] = $report->getTotalCallBySatatus('cancel from dealer & agent', $start, $end);
        $total['cancel_from_hold'] = $report->getTotalCallBySatatus('cancel from hold', $start, $end);
        //$total['card_info_taken'] = $report->getTotalCallBySatatus('card info taken');
        $total['additional_box'] = $report->getTotalCallBySatatus('additional box installation', $start, $end);
        $total['online_payment'] = $report->getTotalCallBySatatus('MONEY ORDER ONLINE PAYMENT', $start, $end);
        $report->getTotalCallBySatatus('check send', $start, $end);
        $total['addsalesreceive'] = $report->addsalesReceive($start, $end);
        $total['totalSupport'] = $report->supportCall($start, $end);
        $total['totaloutbound'] = $report->totalOutbound($start, $end);

        $total['totalAccount'] = $report->accountCall($start, $end);
        $total['inbound'] = $total['totalSupport'] + $total['totalAccount'] + $total['done'] + $total['sales_query'] + $total['reconnection'] + $total['cardinfotaken'] + $total['check_send'] + $total['vod'] + $total['interruption'] + $total['addsalesreceive'] + $total['online_payment'] + $total['cancel'] + $total['cancel_from_da'] + $total['unhold'] + $total['cancel_from_hold'];
        $total['start'] = $start;
        $total['end'] = $end;

        $emailInfo = array(
            'from' => 'info@totalitsolution.com',
            'to' => array('hrahman01@gmail.com',
                'farukmscse@gmail.com',
                'saadmgt@gmail.com',
                'pulakbuds@hotmail.com',
                'ahmodul@live.com',
            ),
            'title' => 'Report',
            'template' => 'report',
            'subject' => 'Report',
            'content' => $total,
            'date' => $tbhead
        );
        $this->sendEmail($emailInfo);

        // End send mail 
    }

}
