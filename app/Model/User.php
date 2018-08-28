<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    var $name = 'users';
    var $belongsTo = array('Role');

    public $validate = array(
        'email' => array(
            'rule' => 'isUnique',
            'required' => true,
            'message' => 'Email already exist'
        ),
        'password' => array(
            'rule' => array('minLength', '6'),
            'message' => 'password must be minimum 6 characters long'
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
        return true;
    }

}

?>