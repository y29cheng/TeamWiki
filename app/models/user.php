<?php
class User extends AppModel {
	public $name = 'User';
	public $validate = array (
		'username' => array(
			'rule' => 'notEmpty'
		),
		'password' => array(
			'required' => true
		),
		'password again' => array(
			'required' => true
		),
		'email' => array(
			'rule' => array('email', true),
			'message' => 'Please supply a valid email address.'
		)
	);
}
?>
