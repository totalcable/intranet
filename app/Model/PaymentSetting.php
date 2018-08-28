<?php

class PaymentSetting extends AppModel {

    var $name = 'payment_settings';
    public $validate = array(
        'issue_id' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Issue already exist'
        )
    );

}

?>