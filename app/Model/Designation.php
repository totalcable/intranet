<?php

class Designation extends AppModel {

    var $name = "designations";
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Name already exist'
        )
    );

}

?>