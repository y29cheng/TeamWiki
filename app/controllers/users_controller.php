<?php
class UsersController extends AppController {
	public $helpers = array('Html', 'Javascript');
	public $name = 'users';
	function register() {
		$username = $this->Session->read('user');
                if ($username) {
                        $this->Session->delete('user');
			$this->Session->setFlash('You logged out successfully.');
                        return;
                }
		if (!empty($this->data)) {
			if ($this->User->findByUsername($this->data['User']['username'])) {
				$this->Session->setFlash('Account exists, log in please.');
				$this->redirect(array('action' => 'login'));
			}
			else {
				if (empty($this->data['User']['password'])) {
					$this->Session->setFlash('Please provide your password.');
					return;
				}
				if ($this->data['User']['password'] !== $this->data['User']['passwd']) {
					$this->Session->setFlash('Passwords don\'t match.');
					return;
				}
				$this->data['User']['password'] = md5($this->data['User']['password']);
				$this->User->save($this->data);
				$this->Session->setFlash('register success');
			}
		}
	}
	function login() {
		$username = $this->Session->read('user');
                if ($username) {
                        $this->Session->delete('user');
                        $this->Session->setFlash('You logged out successfully.');
                        return;
                }
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
