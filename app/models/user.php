<?php
class User extends AppModel {
	public $name = 'User';
	public $validate = array (
		'username' => array(
			'rule' => 'notEmpty',
			'isUnique' => array(
				'rule' => array('isUnique')
			)
		),
		'password' => array(
			'rule' => 'notEmpty',
		),
		'passwd' => array(
			'rule' => 'notEmpty',
		),
		'psword' => array(
			'rule' => 'notEmpty',
		),
		'email' => array(
			'isEmail' => array(
				'rule' => array('email', true),
				'message' => 'Please supply a valid email address.'
			),
			'isUnique' => array(
				'rule' => array('isUnique')
			)
		)
	);
}
?>
