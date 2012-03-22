<script>
$("#settings").css("color", "#fff");
</script>
<?php
echo $this->Form->create('User');
echo $this->Form->label('First Name');
echo $this->Form->text('first_name', array('default' => $user['User']['first_name']));
echo $this->Form->label('Last Name');
echo $this->Form->text('last_name', array('default' => $user['User']['last_name']));
echo $this->Form->label('Username');
echo $this->Form->text('username', array('default' => $user['User']['username'], 'required' => true));
echo $this->Form->label('Old Password');
echo $this->Form->password('pass1');
echo $this->Form->label('New Password');
echo $this->Form->password('pass2');
echo $this->Form->label('Confirm Password');
echo $this->Form->password('pass3');
echo $this->Form->label('Email');
echo $this->Form->text('email', array('default' => $user['User']['email'], 'required' => true));
echo $this->Form->end('submit');
?>

