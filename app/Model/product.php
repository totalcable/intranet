<?php

class Product extends AppModel {

    var $name = "product";
    //public $belongsTo = array('Psetting');
    public $validate = array(
       'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Name already exist')
    );
}

?>