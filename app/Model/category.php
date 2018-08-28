<?php
class Category extends AppModel
{
	var $name = "category";
	public $validate = array(
        'name' => array(
                'rule' => 'isUnique',
                'required' => true,
                'message' => 'This category already exist'
            
        )
     
    );
	
}

?>