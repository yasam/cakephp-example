<h1>User Settings</h1>
<?php

echo $this->Form->create('User', array('action'=>'settings'));
echo $this->Form->input('name');
echo $this->Form->input('email');
echo $this->Form->input('old-password', array('label'=> 'Old Password', 'type'=>'password'));
echo $this->Form->input('password', array('label'=> 'New Password'));
echo $this->Form->input('new-password', array('label'=> 'New Password(again)', 'type'=>'password'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save');
