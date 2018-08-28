<?php

class Option extends AppModel {

    var $name = "option";
    public $validate = array(
        'type' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'This Format already exist'
        )
    );

    function beforeValidate($options = array()) {
        $arr = explode(',', $this->data[$this->alias]['type']);
        $this->data[$this->alias]['type'] = json_encode($arr);
        return true; //this is required, otherwise validation will always fail
    }

    function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['type'])) {
            $arr = explode(',', $this->data[$this->alias]['type']);
            if (count($arr) <= 1) {
                $msg = '<div class="alert alert-danger">
		You should seperate option by comma. i.e: A,B,C,D<strong> Change these things and try again. </strong> </div>';
                $this->error = __($msg);

                return false;
            }

            return true;
        }
    }

}

?>