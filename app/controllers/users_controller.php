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
			$this->User->set($this->data);
			if ($this->User->validates()) {
				if ($this->User->findByUsername($this->data['User']['username'])) {
					$this->Session->setFlash('Username exists');
					return;
				}
				if ($this->User->findByEmail($this->data['User']['email'])) {
					$this->Session->setFlash('Email exists');
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
		$username = $this->Session->read('user');
		if (!$username) {
			$this->redirect(array('action' => 'login'));
			return;
		}
		$user = $this->User->findByUsername($username);
		$this->set('user', $user);
		$this->User->set($this->data);
		if (!empty($this->data)) {
			if ($this->User->validates()) {
				if ($username != $this->data['User']['username'] && $this->User->findByUsername($this->data['User']['username'])) {
					$this->Session->setFlash('Username is already taken.');
					return;
				}
				if ($user['User']['email'] != $this->data['User']['email'] && $this->User->findByEmail($this->data['User']['email'])) {
					$this->Session->setFlash('Email is already taken.');
					return;
				}
				if ($this->data['User']['pass1']) {
					if ($user['User']['password'] != md5($this->data['User']['pass1'])) {
						$this->Session->setFlash('Old password is wrong.');
						return;
					}
					if ($this->data['User']['pass2'] !== $this->data['User']['pass3']) {
						$this->Session->setFlash('New passwords don\'t match.');
						return;
					}
					$this->data['User']['pass1'] = $this->data['User']['pass2'];
				}
				$new = array('first_name' => $this->data['User']['first_name'], 
					'last_name' => $this->data['User']['last_name'], 
					'username' => $this->data['User']['username'], 
					'password' => md5($this->data['User']['pass1']), 
					'email' => $this->data['User']['email']
				);
				$update = update_profile($username, $new);
				if ($update) {
					$this->Session->setFlash('Profile is updated.');
				} else {
					$this->Session->setFlash('Profile is not updated.');
				}
			}
		}
	}
		
}
?>
