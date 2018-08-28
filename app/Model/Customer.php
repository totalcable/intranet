<?php

class Customer extends AppModel {
    var $name = "customers";
    public $validate = array(
        'email' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Email already exist',
            'on' => 'create'
        )
    );
}

?>