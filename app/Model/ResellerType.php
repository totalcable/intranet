<?php

class ResellerType extends AppModel {

    var $name = "resellerType";
    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This type already exist'
        )
    );

}

?>