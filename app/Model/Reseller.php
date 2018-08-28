<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Reseller extends AppModel {

    // var $name = "reseller";
    //  public $belongsTo = array(
    //     'Order' => array(
    //         'className' => 'Order',
    //         'foreignKey' => 'api_key'
    //     )
    // );

    public $validate = array(
        'email' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Email already exist',
            'on' => 'create'
        ),
        'password' => array(
            'rule' => array('minLength', '4'),
            'message' => 'password must be minimum 4 characters long'
        )
    );

    function hashPassword() {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
    }
    function beforeSave($options = array()) {
        $this->hashPassword();
        $this->data[$this->alias]['resetkey'] = Security::hash(mt_rand(), 'md5', true);
        return true;
    }

}

?>