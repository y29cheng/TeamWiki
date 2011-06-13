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
	function login() {
		if(!empty($this->data)) {
			$dbuser = $this->User->findByUsername($this->data['User']['username']);
			if(!$dbuser) {
				$this->redirect(array('action' => 'register'));
			}
			else {
				if( $dbuser['password'] === $this->data['User']['password'] ) {
	
					$this->Session->write('user', $dbuser->username);
					$this->Session->setFlash('Your logged in as ' . $dbuser . '. Welcome!');
					$this->redirect(array('controller' => 'posts', 'action' => 'index'));
				}
				else {
					$this->Session->setFlash('Log in falied');
				}
			}
		}
	}
}
?>
