<?php
class UsersController extends AppController {
	public $name = 'users';
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
				if( $dbuser['User']['password'] === $this->data['User']['password'] ) {
	
					$this->Session->write('user', $dbuser->username);
					$this->Session->setFlash('Your logged in as ' . $dbuser['User']['username'] . '. Welcome!');
					$this->redirect(array('controller' => 'posts', 'action' => 'index'));
				}
				else {
					$this->Session->setFlash('Log in falied');
				}
			}
		}
	}
	function logout($uname = null) {
		$this->User->username = $uname;
		$this->Session->delete($this->User->username);
		$this->Session->setFlash('You logged out successfully.');
		$this->redirect(array('action' => 'login'));
	}
}
?>
