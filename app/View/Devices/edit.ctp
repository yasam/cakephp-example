<h3>Edit User</h3>
<?php

echo $this->Form->create('Device', array('action'=>'edit'));
echo $this->Form->input('name');
echo $this->Form->input('serial');
echo $this->Form->input('owner');
echo $this->Form->input('comment');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Device');
