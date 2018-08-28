<?php
/**
* 
*/
class Location extends AppModel
{
	var $name = "location";
	public $validate = array(
    'name' => array(
        'unique' => array(
            'rule' => array('checkUnique', array('name', 'city_id'), false), 
            'message' => 'This Location already exist'
        )
    )
);

}

?>