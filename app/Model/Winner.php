<?php
/**
* 
*/
class Winner extends AppModel
{
	var $name = "winner";
    public $validate = array(
    'reseller_id' => array(
        'unique' => array(
            'rule' => array('checkUnique', array('reseller_id', 'date'), false), 
            'message' => 'This Chapter already exist'
        )
    )
);
}

?>