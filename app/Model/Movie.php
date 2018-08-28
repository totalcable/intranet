<?php

/**
 * 
 */
class Movie extends AppModel {

    var $name = "movies";
     public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Name already exist'
        )
    );

}

?>