<?php
echo $this->Form->create('User');
echo $this->Form->password('Old Password');
echo $this->Form->password('New Password');
echo $this->Form->password('Confirm Password');
echo $this->Form->end('submit');
?>

