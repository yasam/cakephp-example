<?php
class State extends AppModel {
    public $name = 'State';
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'serial' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'An e-mail is required'
            )
        ),
        'status' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'ip' => array(
            'required' => array(
                'rule' => array('notEmpty')
            )
        ),
        'port' => array(
			   'rule' => 'notEmpty'
      ),
        'ses_start' => array(
			   'rule' => 'notEmpty'
      ),
        'ses_end' => array(
			   'rule' => 'notEmpty'
      )
    );
}
