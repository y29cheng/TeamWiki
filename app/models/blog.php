<?php
class Blog extends AppModel {
	public $name = 'Blog';
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		)
	);
}
?>
