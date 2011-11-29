<?php
echo $this->Form->create('User');
echo $this->Form->input('first_name', array('default' => $user['User']['first_name']));
echo $this->Form->input('last_name', array('default' => $user['User']['last_name']));
echo $this->Form->input('username', array('default' => $user['User']['username']));
echo $this->Form->input('password', array('label' => 'Old Password', 'default' => $user['User']['password']));
echo $this->Form->input('passwd', array('label' => 'New Password', 'default' => $user['User']['password']));
echo $this->Form->input('psword', array('label' => 'Confirm Password', 'default' => $user['User']['password']));
echo $this->Form->input('email', array('default' => $user['User']['email']));
echo $this->Form->end('submit');
?>

