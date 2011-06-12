<?php
class User extends AppModel {
	public $name = 'User';
	public $validate = array (
		'username' => VALID_NOT_EMPTY,
		'password' => VALID_NOT_EMPTY,
		'email' =>VALID_EMAIL
	);
}
?>
