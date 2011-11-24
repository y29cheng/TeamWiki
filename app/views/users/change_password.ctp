<?php
echo $this->Form->create('User');
echo $this->Form->password('Old Password', array('id' => 'password1', 'label' => 'Old Password');
echo $this->Form->password('New Password', array('id' => 'password2', 'label' => 'New Password');
echo $this->Form->password('Confirm Password', array('id' => 'password3', 'label' => 'Confirm Password');
echo $this->Form->end('submit');
?>

