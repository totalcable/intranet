
<?php

/**
 * 
 */
class PackageCustomer extends AppModel {
    //var $name = "PackageCustomers";
    var $belongsTo = array('User', 'Psetting', 'CustomPackage');
    //var $belongsTo = array('Psetting');
    
//     public $validate = array(
//        'mac' => array(
//            'rule' => 'isUnique',
//            'required' => true,
//            'message' => 'Mac no already exist'
//        )
//    );

}

?>