<h3>Add Station</h3>
<?php echo $this->Form->create('Device');?>
<?php
	echo $this->Form->input('name');
	echo $this->Form->input('serial');
	echo $this->Form->input('owner');
	echo $this->Form->input('comment');
?>
<?php echo $this->Form->end(__('Submit'));?>
