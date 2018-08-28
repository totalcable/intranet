<?php
class Assignment extends AppModel
{
    var $name = "assignment";
       var $belongsTo = array('Level','Subject','Chapter');
  
public $validate = array(
        'question' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Assignment already exist'
        )
    );
}

?>