<?php
echo $this->Form->create('User');
echo $this->Form->input('first_name', array('default' => $user['User']['first_name']));
echo $this->Form->input('last_name', array('default' => $user['User']['last_name']));
echo $this->Form->input('username', array('default' => $user['User']['username']));
echo $this->Form->password('pass1', array('label' => 'Old Password'));
echo $this->Form->password('pass2', array('label' => 'New Password'));
echo $this->Form->password('pass3', array('label' => 'Confirm Password'));
echo $this->Form->input('email', array('default' => $user['User']['email']));
echo $this->Form->end('submit');
?>

