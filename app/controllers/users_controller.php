<?php
class UsersController extends AppController {
	function register() {
		if (!empty($this->params['form'])) {
			if ($this->User->save($this->params['form'])) {
				$this->Session->setFlash('register success');
			}
			else {
				$this->Session->setFlash('register failure');
			}
		}
	}
}
?>
