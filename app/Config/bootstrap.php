<?php

/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));
App::uses('ClassRegistry', 'Utility');

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */
/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
/**
 * To prefer app translation over plugin translation, you can set
 *
 * Configure::write('I18n.preferApp', true);
 */
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 * 		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 * 		'MyCacheFilter' => array('prefix' => 'my_cache_'), //  will use MyCacheFilter class from the Routing/Filter package in your app with settings array.
 * 		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 * 		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'File',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'File',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

function humantime($time, $alreadyPassed = false) {
    $status = 'btn btn-sm grey-cascade" >';
    if ($time >= 43200 || $alreadyPassed) {
        if ($alreadyPassed) {
            $status = 'btn btn-sm red" >- ';
        } else {

            $status = 'btn btn-sm red" >';
        }
    }

    $y = floor($time / 31536000);
    $time = $time - $y * 31536000;
    $M = floor($time / 2592000);
    $time = $time - $M * 2592000;
    $w = floor($time / 604800);
    $time = $time - $w * 604800;
    $d = floor($time / 86400);
    $time = $time - $d * 86400;
    $h = floor($time / 3600);
    $time = $time - $h * 3600;
    $m = floor($time / 60);
    $time = $time - $m * 60;
    $s = $time;
    $output = '<a href = "#" class = "';
    $output .=$status;
    if ($y) {
        if ($y > 1)
            $output.=$y . ' years ';
        else
            $output.=$y . ' year ';
    }
    if ($M) {
        if ($M > 1)
            $output.=$M . ' months ';
        else
            $output.=$M . ' month ';
    }
    if ($w) {
        if ($w > 1)
            $output.=$w . ' weeks ';
        else
            $output.=$w . ' week ';
    }
    if ($d) {
        if ($d > 1)
            $output.=$d . ' days ';
        else
            $output.=$d . ' day ';
    }
    $output.= $h . ':' . $m . ':' . $s . '</a>';
    return $output;
}

function remainingTime($input) {
    $time = strtotime($input);
    $time = $time - time();  // to get the time since that moment

    if ($time < 0) {
        $time = $time * (-1);
        return humantime($time, true);
    } else {
        return humantime($time, false);
    }
}

function passedTime($input) {
    $time = strtotime($input);
    $time = time() - $time;  // to get the time since that moment
    return humantime($time);
}

function remove_duplicate($original, $pkey, $ckey) {

    $unique = array_intersect_key($original, array_unique(
                    array_map(function($item) {
                        //return $item['Import']['product_id'];
                        return $item['Import']['product_id'];
                    }, $original)
            )
    );
    return $unique;
}

function get_discount($items, $sc) {
    foreach ($sc as $single) {
        if ($single['ServiceCharge']['pieces'] == $items)
            return $single['ServiceCharge']['discount'];
    }
}

function generationAns($options = array(), $ans = array()) {
    $output = '';
    foreach ($options as $key => $option) {
        $output .= '<label class = "checkbox-inline">
                  <input type = "checkbox"  disabled ';
        if (in_array($key, $ans)) {
            $output .= ' checked="checked"';
        }
        $output .='>' .
                $option .
                '</label>';
    }
    return $output;
}

if (!function_exists('array_column')) {

    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if (!isset($value[$columnKey])) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            } else {
                if (!isset($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if (!is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }

}

function show_footer_component($searchField = null, $data = array()) {
    $key = array_search($searchField, array_column(array_column($data, 'Footer'), 'field'));
    echo htmlspecialchars_decode(stripslashes($data[$key]['Footer']['fvalue']));
}

function get_footer_component($searchField = null, $data = array()) {
    $key = array_search($searchField, array_column(array_column($data, 'Footer'), 'field'));
    return htmlspecialchars_decode(stripslashes($data[$key]['Footer']['fvalue']));
}

function get_emergency_help() {
    $footer = ClassRegistry::init('Footer');
    $footerSetting = $footer->find('all');

    $help = '<div class="alert alert-success" style="text-align:center;">
            
            <strong> Call <span style="color:red;">' . get_footer_component('emergency', $footerSetting) . '</span> to get emergency help </strong>
        </div>';
    return $help;
}

function get_emergency_help_plaintxt() {
    $footer = ClassRegistry::init('Footer');
    $footerSetting = $footer->find('all');

    $help = '<i> Call ' . get_footer_component('emergency', $footerSetting) . ' to get emergency help </i>';
    return $help;
}

function get_average_review($reviews = array()) {

    $total = 0;
    foreach ($reviews as $review):
        $total += $review['Review']['rating'];
    endforeach;
    if (count($reviews) == 0) {
        return 0;
    }
    return $total / count($reviews);
}

function getInvoiceNumbe($number) {
    $digits = strlen($number);
    $format = 6;
    $traling_zero = $format - $digits;
    for ($i = 0; $i < $traling_zero; $i++) {
        $number = '' . $number;
    }
    return $number;
}

function show_mac($data) {
    $output = '';
    $macs = json_decode($data['mac']);

    $sys = json_decode($data['system']);
    if (is_array($macs)) {
        foreach ($macs as $index => $mac) {
            $output.='<span class="fa fa-star" style="font-size: 21px; letter-spacing: 1px;">&nbsp;' . $mac . '(' . $sys[$index] . ')</span> &nbsp;';
        }
    }


    return $output;
}

function generate_mac($data) {

    $output = '';
    $macs = json_decode($data['mac']);
//    $sys = json_decode($data['system']);
    if (is_array($macs)) {
        foreach ($macs as $index => $mac) {
//            $output.='<label class="checkbox-inline"><input type="checkbox" name="mac[]" id="inlineCheckbox1" value="' . $index . '">' . $mac . '</label>';
            $output.='<label class="checkbox-inline"><input type="checkbox" name="mac[]" id="inlineCheckbox1" value="' . $mac . '">' . $mac . '</label>';
        }
    }
    return $output;
}

function get_canceled_mac($macs = array(), $cancel_mac = array()) {

    $output = 'No mac was selected to cancel';
    $macs = json_decode($macs);
    $cancel_macs = json_decode($cancel_mac);
//    $sys = json_decode($data['system']);

    if (is_array($cancel_macs)) {
        $output = '';
        foreach ($cancel_macs as $index => $val) {
            $output.='<li>' . $macs[$val] . '</li>';
        }
    }
    return $output;
}

function sendEmail2($content = array(), $to= array(), $template) {
    $Email = new CakeEmail();
    $email_data = array(
        'hash' => $subject);
    // $Email->config('custom')
    $Email->template($template)
            ->emailFormat('html')
            ->from(array($from => $content['from']))
            ->attachments(array(
                array(
                    'file' => ROOT . '/app/webroot/media/logo-corp-red.png',
                    'mimetype' => 'image/png',
                    'contentId' => '12345'
                ),
                array(
                    'file' => ROOT . '/app/webroot/media/facebook.png',
                    'mimetype' => 'image/png',
                    'contentId' => '123456'
                ),
                array(
                    'file' => ROOT . '/app/webroot/media/twitter.png',
                    'mimetype' => 'image/png',
                    'contentId' => '1234567'
                ),
            ))
            ->viewVars($email_data)
            ->to($to)
            ->subject($content['subject']);

    $Email->send($body);
}

function sendEmail($from, $name, $to, $subject, $body) {
    $tests = array();
    foreach ($to as $user) {
        $tests[] = $user;
    }
    $Email = new CakeEmail();
    $email_data = array(
        'hash' => $subject);
    // $Email->config('custom')
    $Email->template('contactForm')
            ->emailFormat('html')
            ->from(array($from => $name))
            ->attachments(array(
                array(
                    'file' => ROOT . '/app/webroot/media/logo-corp-red.png',
                    'mimetype' => 'image/png',
                    'contentId' => '12345'
                ),
                array(
                    'file' => ROOT . '/app/webroot/media/facebook.png',
                    'mimetype' => 'image/png',
                    'contentId' => '123456'
                ),
                array(
                    'file' => ROOT . '/app/webroot/media/twitter.png',
                    'mimetype' => 'image/png',
                    'contentId' => '1234567'
                ),
            ))
            ->viewVars($email_data)
            ->to($tests)
            ->subject($subject);

    $Email->send($body);
}
function sendInvoice($from, $name, $to, $subject, $body) {
    $tests = array();
    foreach ($to as $user) {
        $tests[] = $user;
    }
    $Email = new CakeEmail();
    $email_data = array(
        'hash' => $subject);
    // $Email->config('custom')
    $Email->template('invoice')
            ->emailFormat('html')
            ->from(array($from => $name))
            ->attachments(array(
                array(
                    'file' => ROOT . '/app/webroot/media/logo-corp-red.png',
                    'mimetype' => 'image/png',
                    'contentId' => '12345'
                ),
                array(
                    'file' => ROOT . '/app/webroot/media/facebook.png',
                    'mimetype' => 'image/png',
                    'contentId' => '123456'
                ),
                array(
                    'file' => ROOT . '/app/webroot/media/twitter.png',
                    'mimetype' => 'image/png',
                    'contentId' => '1234567'
                ),
            ))
            ->viewVars($email_data)
            ->to($tests)
            ->subject($subject);

    $Email->send($body);
}

 function getPaid($id = null) {
        $ptr = ClassRegistry::init('Transaction');
        if(empty($id)){
            $id = 0;
        }
        $sql = 'SELECT SUM(payable_amount) as paid FROM transactions WHERE transaction_id =' . $id;
//        echo $sql;
        $data = $ptr->query($sql);
      //  pr($data);
      //  exit;
      //  return $data;
        $paid = 0;
        if(count($data)){
           $paid = $data[0][0]['paid']; 
        }
        return  round($paid,2); 
    }
 function getFullPayment($id = 0) {
        $ptr = ClassRegistry::init('Transaction');
       // pr($id); exit;
        if(empty($id)){
            $id = 0;
        }
        $sql = 'SELECT payable_amount as paid FROM transactions WHERE id =' . $id;
      // echo $sql; exit;
        $data = $ptr->query($sql);
        //return $data;
        $paid = 0;
        if(count($data)){
           $paid = $data[0]['transactions']['paid']; 
        }
        return  $paid;
    }

