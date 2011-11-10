<?php
class Vote extends AppModel {
	public $name = 'Vote';
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
		),
		'choice1' => array(
			'rule' => 'notEmpty'
		),
		'choice2' => array(
                        'rule' => 'notEmpty'
                ),
		'choice3' => array(
                        'rule' => 'notEmpty'
                ),
		'choice4' => array(
                        'rule' => 'notEmpty'
                )
	);
}
?>
