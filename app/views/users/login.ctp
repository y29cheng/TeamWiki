<h1>Login</h1>
<?php
echo $this->Html->link('Register', array('action' => 'register'));
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('login');
?>
