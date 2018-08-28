<?php
/**
* 
*/
class City extends AppModel
{
	var $name = "cities";
        public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'City already exist'
        )
    );
}

?>