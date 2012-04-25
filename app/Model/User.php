<?php
// app/Model/User.php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
    public $name = 'User';
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'An e-mail is required'
            )
        ),
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'old-password' => array(
			'rule' => array('oldPasswordCheck'),
			'message' => 'Old password mismatches.'
        ),
		'new-password' => array(
			'rule' => array('equalityCheck'),
			'message' => 'New password mismatches.'
		),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'oper')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
                $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
		return true;
    }
	
	public function oldPasswordCheck($data)
	{
		
		$orig = $this->find('first', array('conditions' => array('User.id' => $this->data[$this->name]['id'])));
		
		if($orig['User']['password'] == AuthComponent::password($data['old-password']))
			return true;
		
		return false;
	}

	public function equalityCheck($data)
	{
		if($this->data[$this->name]['password'] == $data['new-password'])
			return true;
		
		return false;
	}
}
