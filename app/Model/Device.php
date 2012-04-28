<?php
// app/Model/User.php
class Device extends AppModel {
    public $name = 'Device';
    public $hasMany = array(
        'DeadState' => array(
            'className'  => 'State',
            'conditions' => array('DeadState.status' => 'CLOSED'),
            'order'      => 'DeadState.ses_end DESC',
            'foreignKey' => 'serial',
            'limit' => 1 
        ),
        'LiveState' => array(
            'className'  => 'State',
            'conditions' => array('LiveState.status' => 'SUBSCRIBED'),
            //'order'      => 'LiveState.ses_start DESC',
            'foreignKey' => 'serial'
        )
    );
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'serial' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'A serial is required'
            )
        ),
        'owner' => array(
        ),
        'comment' => array(
        )
    );  
}
