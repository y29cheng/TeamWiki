<?php
class PostsController extends AppController {
	public $helper = array ( 'Html', 'Form' );
	public $name = 'posts';
	function index() {
		$username = $this->Session->read('user');
		if( $username ) {
			$this->Session->setFlash('You are logged in as '. $username . ' . Welcome!');
			$this->set('posts', $this->Post->find('all'));
		}
		else {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}
	function view($id = null) {
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());
	}
	function add() {
 		if (!empty($this->data)) {
			$this->data['Post']['name'] = $this->Session->read('user');
 			if ($this->Post->save($this->data)) {
 				$this->Session->setFlash('Your post has been saved.');
 				$this->redirect(array('action' => 'index'));
 			}
 		}
 	}
	function delete($id) {
		if( $this->Session->read('user') === $this->Post->name ) {
			$this->Post->delete($id);
			$this->Session->setFlash('The post with id: '. $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
		else {
			$this->Session->setFlash('You are not allowed to delete other users posts!');
			$this->redirect(array('action' => 'index'));
		}
	}
	function edit($id = null) {
		if( $this->Session->read('user') === $this->Post->name ) {
			$this->Post->id = $id;
			if(empty($this->data)) {
				$this->data = $this->Post->read();
			}
			else {
				$this->Post->save($this->data);
				$this->Session->setFlash('The post with id: '. $id .' has been modified');
				$this->redirect(array('action'=>'index'));
			}
		}
		else {
			$this->Session->setFlash('You are not allowed to edit other users posts!');
			$this->redirect(array('action' => 'index'));
		}
	}
}
?>
