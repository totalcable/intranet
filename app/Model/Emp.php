<?php

class Emp extends AppModel {

    var $name = "emps";
    public $validate = array(
        'email' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This email already exist'
        ),
        'staff_id' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This staff Id already exist'
        )
    );

}

?>