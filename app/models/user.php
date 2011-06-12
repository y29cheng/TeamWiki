<?php
class User extends AppModel {
	public $name = 'User';
	public $validate = array (
		'username' => 'notEmpty',
		'password' => 'notEmpty',
		'email' => 'notEmpty'
	);
}
?>
