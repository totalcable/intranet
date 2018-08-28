<?php
/**
 * 
 */
class Package extends AppModel {
    var $name = "Package";
    // var $belongsTo = array('Psetting');
  
       public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This package already exist you can modify it'
        )
    );
    
}
?>
