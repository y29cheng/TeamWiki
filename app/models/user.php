<?php
class User extends AppModel {
	public $name = 'User';
	public $validate = array (
		'username' => array(
			'rule' => 'notEmpty'
		),
		'password' => array(
			'rule' => 'notEmpty'
		),
		'email' => array(
			'rule' => array('email', true),
			'rule' => 'notEmpty'
		)
	);
}
?>
