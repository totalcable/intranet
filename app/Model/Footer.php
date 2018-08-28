<?php
class Footer extends AppModel
{
	var $name = "footer";
     
	  public $validate = array(
        'field' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This field already exist'
        )
    );
    	
}

?>