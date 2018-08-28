<?php
class Level extends AppModel
{
	var $name = "level";
        var $belongsTo = array('Option');
	  public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Level already exist'
        )
    );
    	
}

?>