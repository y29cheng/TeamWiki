<h1>Login</h1>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('login');
echo $this->Html->link('Forgot your password?', array('action' => 'reset_password'));
?>
