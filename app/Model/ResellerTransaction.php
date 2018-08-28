<?php

class ResellerTransaction extends AppModel {

    var $name = "resellerTransaction";
    public $validate = array(
        'amount' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Setting already exist'
        )
    );

}

?>