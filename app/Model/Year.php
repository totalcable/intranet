<?php
class year extends AppModel
{
	var $name = "year";
public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This year already exist'
        )
    );
}

?>