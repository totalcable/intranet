<?php

class Department extends AppModel {

    var $name = "departments";
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Name already exist'
        )
    );

}

?>