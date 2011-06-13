<?php
class UsersController extends AppController {
	function register() {
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('register success');
			}
			else {
				$this->Session->setFlash('register failure');
			}
		}
	}
}
?>
