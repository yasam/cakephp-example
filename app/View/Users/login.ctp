<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
   <?php echo __('Please enter your username and password'); ?>
   <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');

        echo $this->TB->input('xusername', array(
        	    "input" => $this->Form->text("xusername"),
            	    "help_inline" => "Text to the right of the input",
                    "help_block" => "Text under the input"
                ));
        echo $this->TB->basic_input('xpassword',  array(
        	    "label" => "Custom label text"
        	));
    ?>
<?php echo $this->Form->end(__('Login'));?>
