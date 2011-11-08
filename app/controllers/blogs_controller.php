<?php
class BlogsController extends AppController {
	public $name = 'blogs';
	function index() {
		$username = $this->Session->read('user');
		if ($username) {
			$this->set('blogs', $this->Blog->find('all'));
		} else {
			$this->redirect(array('controller' => 'user', 'action' => 'login'));
		}
	}
	function view($id = null) {
		$this->Blog->id = $id;
		$this->set('blog', $this->Blog->read());
	}
	function add() {
		$username = $this->Session->read('user');
		if ($username !== 'admin') {
			$this->Session->setFlash('Only the admin can post blogs.');
			$this->redirect(array('action' => 'index'));
		} else {
			if (!empty($this->data)) {
				if ($this->Blog->save($this->data)) {
					$this->Session->setFlash('Your blog has been saved.');
					$this->redirect(array('action' => 'index'));
				}
			} else {
					$this->Session->setFlash('Please write something in your blog.');
			}
		}
	}
	function delete($id) {
		$blog = $this->Blog->findById($id);
		$username = $this->Session->read('user');
		if ($username !== 'admin') {
			$this->Session->setFlash('Only the admin can delete blogs');
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Blog->delete($id);
			$this->Session->setFlash('The blog with id: '.$id.' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	function edit($id = null) {
		$blog = $this->Blog->findById($id);
                $username = $this->Session->read('user');
		if ($username !== 'admin') {
                        $this->Session-setFlash('Only the admin can edit blogs');
                        $this->redirect(array('action' => 'index'));
		} else {
			if (empty($this->data)) {
				$this->data = $this->Blog->read();
			} else {
				$this->Blog->save($this->data);
				$this->Session->setFlash('The blog with id: '.$id.' has been modified.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
