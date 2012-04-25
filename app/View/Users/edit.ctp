<h1>Edit User</h1>
<?php

echo $this->Form->create('User', array('action'=>'edit'));
echo $this->Form->input('name');
echo $this->Form->input('email');
//echo $this->Form->input('role');
echo $this->Form->input('role', array('options' => array('admin'=>'Admin', 'oper'=>'Operator')));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save User');
