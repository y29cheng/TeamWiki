<?php
class UsersController extends AppController {
	var $helpers = array('Html', 'Javascript');
	public $name = 'users';
	function register() {
		if (!empty($this->data)) {
			if ($this->User->findByUsername($this->data['User']['username'])) {
				$this->Session->setFlash('Account exists, log in please.');
				$this->redirect(array('action' => 'login'));
			}
			else {
				$this->data['User']['password'] = md5($this->data['User']['password']);
				$this->User->save($this->data);
				$this->Session->setFlash('register success');
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
				if( $dbuser['User']['password'] === md5($this->data['User']['password']) ) {
	
					$this->Session->write('user', $dbuser['User']['username']);
					//$this->Session->setFlash('Your logged in as ' . $dbuser['User']['username'] . '. Welcome!');
					$this->redirect(array('controller' => 'posts', 'action' => 'index'));
				}
				else {
					$this->Session->setFlash('Log in failed');
				}
			}
		}
	}
	function logout() {
		$this->Session->delete('user');
		$this->Session->setFlash('You logged out successfully.');
		$this->redirect(array('action' => 'login'));
	}
}
?>
