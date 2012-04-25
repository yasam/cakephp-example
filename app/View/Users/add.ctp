<!-- app/View/Users/add.ctp -->
<h1>Add Txn</h1>
<?php echo $this->Form->create('User');?>
<?php
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('name');
	echo $this->Form->input('email');
	echo $this->Form->input('role', array(
		'options' => array('admin' => 'Admin', 'oper' => 'Operator')
	));
?>
<?php echo $this->Form->end(__('Submit'));?>
