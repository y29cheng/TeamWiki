<?php
echo $this->Form->create('User');
echo $this->Form->password('password', array('label' => 'Old Password'));
echo $this->Form->password('passwd', array('label' => 'New Password'));
echo $this->Form->password('psword', array('label' => 'Confirm Password'));
echo $this->Form->end('submit');
?>

