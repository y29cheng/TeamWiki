<?php
App::import('Vendor', 'password');
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
			} else {
				$this->User->set($this->data);
				if ($this->User->validates()) {
					$this->data['User']['password'] = md5($this->data['User']['password']);
                                	$this->User->save($this->data);
                                	$this->Session->setFlash('register success');
				} else {
					if (empty($this->data['User']['username'])) {
						$this->Session->setFlash('Please provide your username.');
						return;
					}
					if (empty($this->data['User']['password'])) {
						$this->Session->setFlash('Please provide your password.');
						return;
					}
					if ($this->data['User']['password'] !== $this->data['User']['passwd']) {
						$this->Session->setFlash('Passwords don\'t match.');
						return;
					}
					$this->Session->setFlash('Invalid email address');
					return;
				}
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
		if (!empty($this->data)) {
			$dbuser = $this->User->findByUsername($this->data['User']['username']);
			if (!$dbuser) {
				$this->redirect(array('action' => 'register'));
			} else {
				if ($dbuser['User']['password'] === md5($this->data['User']['password']) ) {
	
					$this->Session->write('user', $dbuser['User']['username']);
					$this->redirect(array('controller' => 'posts', 'action' => 'index'));
				} else {
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
	function reset_password() {
		if ($this->Session->read('user')) {
			$this->Session->delete('user');
			$this->Session->setFlash('You have logged out successfully');
		}
		if (empty($this->data['User']['email'])) return;
		$requester = $this->User->findByEmail($this->data['User']['email']);
		if (!$requester) {
			$this->Session->setFlash('Sorry, your email does not exist in our database.');
			return;
		}
		$to = $requester['User']['email'];
		$subject = 'Password Reset';
		$newPassword = generate_password();
		$message = 'Your new password is '.$newPassword."\n";
		$message .= "Please do not reply to this email.\n";
		$message = wordwrap($message, 70);
		$headers = "From: webmaster@teamwiki.phpfogapp.com\r\n";
		$update = update_password($requester['User']['password'], md5($newPassword));
		if (!$update) {
			$this->Session->setFlash('Email is not delivered.');
			return;
		}
		$mail = mail($to, $subject, $message, $headers);
		if ($mail) {
			$this->Session->setFlash('Email has been sent.');
		} else {
			$this->Session->setFlash('Email is not delivered.');
		}
	}
	function change_password() {
		if (!$this->Session->check('user')) {
			$this->redirect(array('action' => 'login'));
			return;
		}
		if (!empty($this->data['User']['password'])) {
			$requester = $this->User->findByPassword(md5($this->data['User']['password']));
			if ($requester) {
				if (!empty($this->data['User']['passwd']) && $this->data['User']['passwd'] === $this->data['User']['psword']) {
					$update = update_password($requester['User']['password'], md5($this->data['User']['passwd']));
					if ($update) {
						$this->Session->setFlash('Password is updated.');
					} else {
						$this->Session->setFlash('Password is not updated.');
					}
				} else {
					$this->Session->setFlash('Passwords don\'t match.');
				}
			} else {
				$this->Session->setFlash('Your password is wrong.');
			}
		} else {
			$this->Session->setFlash('Please provide your password.');
		}
	}
		
}
?>
