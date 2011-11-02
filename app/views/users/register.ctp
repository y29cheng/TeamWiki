<h1>Register</h1>
<?php
echo $this->Html->link('Log in', array('action' => 'login'));
echo $this->Form->create('User');
echo $this->Form->input('first_name');
echo $this->Form->input('last_name');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('email');
echo $this->Form->end('register');
?>
