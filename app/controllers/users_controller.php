<?php
class UsersController extends AppController {
	function register() {
		if (!empty($this->params['form'])) {
			if ($this->User->save($this->params['form'])) {
				$this->Session->flash('register success', '/users/register');
			}
			else {
				$this->Session->flash('register failure', '/user/register');
			}
		}
	}
}
?>
