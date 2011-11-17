<?php
class PostsController extends AppController {
	public $helpers = array ( 'Html', 'Form', 'Javascript' );
	public $name = 'posts';
	function index() {
		$username = $this->Session->read('user');
		if ($username) {
			$this->set('posts', $this->Post->find('all'));
		} else {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}
	function view($id = null) {
		$username = $this->Session->read('user');
		if (!$username) {
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        return;
                }
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());
	}
	function add() {
		$username = $this->Session->read('user');
                if (!$username) {
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        return;
                }
 		if (!empty($this->data)) {
			$this->data['Post']['name'] = $this->Session->read('user');
 			if ($this->Post->save($this->data)) {
 				$this->Session->setFlash('Your post has been saved.');
 				$this->redirect(array('action' => 'index'));
 			}
 		}
 	}
	function delete($id) {
		$post = $this->Post->findById($id);
		$username = $this->Session->read('user');
                if (!$username) {
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        return;
                }
		if ($username === $post['Post']['name']) {
			$this->Post->delete($id);
			$this->Session->setFlash('The post with id: '. $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash('You are not allowed to delete other users posts!');
			$this->redirect(array('action' => 'index'));
		}
	}
	function edit($id = null) {
		$post = $this->Post->findById($id);
		$this->Post->id = $id;
		$username = $this->Session->read('user');
                if (!$username) {
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                        return;
                }
		if ($username === $post['Post']['name']) {
			if(empty($this->data)) {
				$this->data = $this->Post->read();
			} else {
				$this->Post->save($this->data);
				$this->Session->setFlash('The post with id: '. $id .' has been modified');
				$this->redirect(array('action'=>'index'));
			}
		} else {
			$this->Session->setFlash('You are not allowed to edit other users posts!');
			$this->redirect(array('action' => 'index'));
		}
	}
}
?>
