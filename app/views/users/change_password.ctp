<?php
echo $this->Form->create('User');
echo $this->Form->input('password', array('label' => 'Old Password'));
echo $this->Form->input('passwd', array('label' => 'New Password'));

echo $this->Form->input('psword', array('label' => 'Confirm Password'));
echo $this->Form->end('submit');
?>

