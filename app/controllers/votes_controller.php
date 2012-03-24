<?php
App::import('Vendor', 'iredis');
App::import('Helper', 'Input');
App::import('Helper', 'Mongo');
class VotesController extends AppController {
	public $helpers = array('Html', 'Form', 'Javascript', 'Input', 'Mongo');
	public $name = 'votes';
	private $user = 'georgeC';
	private $pass = 'T3aMW1k14PP';
	function index() {
		$username = $this->Session->read('user');
        	if ($username) {
        		$m = new MongoHelper();
                $collection = $m->connect($this->user, $this->pass);
                $this->set('votes', $collection->find());
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
        $m = new MongoHelper();
        $collection = $m->connect($this->user, $this->pass);
   	    $this->set('vote', $collection->findOne(array('_id' => new MongoId($id))));
    }
	function add() {
		$username = $this->Session->read('user');
		if (!$username) {
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
			return;
		}       
		if (!empty($this->data)) {
			$obj = array();
			$obj['title'] = $this->data['Vote']['title'];
			$obj['owner'] = $username;
			$obj['voters'] = array();
			$obj['created'] = date('Y-m-d');
			$obj['modified'] = $obj['created'];
			$obj['expire'] = $this->data['Vote']['expire'];
			$i = 0;
			for ($i=1;;$i++) {
				if (isset($this->data['Vote']['choice'.$i])) {
					$obj['choice'.$i] = $this->data['Vote']['choice'.$i];
					$obj['answer'.$i] = 0; 
				} else {
					break;
				}
			}
			$obj['choices'] = $i - 1;
			$input = new InputHelper();
			if (!$input->validate($obj)) {
				$this->Session->setFlash('Your vote contains errors.');
				return;
			}
			$m = new MongoHelper();
            $collection = $m->connect($this->user, $this->pass);
            try {
				$collection->insert($obj, array('safe' => true));
				$this->Session->setFlash('Your vote has been saved.');
				$this->redirect(array('action' => 'index'));
			} catch (MongoCursorException $e) {
				$this->Session->setFlash('Your vote is not saved.');
			}
    	}
    }
	function delete($id) {
		$m = new MongoHelper();
		$collection = $m->connect($this->user, $this->pass);
    	$vote = $collection->findOne(array('_id' => new MongoId($id)));
        $username = $this->Session->read('user');
        if (!$username) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        	return;
        }
        if ($username != $vote['owner']) {
        	$this->Session->setFlash('You can\'t delete other users\' vote.');
            $this->redirect(array('action' => 'index'));
        } else {
        	try {
            	$collection->remove(array('_id' => new MongoId($id)), array('safe' => true));
            	$this->Session->setFlash('The vote with id: '.$id.' has been deleted.');
            	$this->redirect(array('action' => 'index'));
        	} catch (MongoCusorException $e) {
        		$this->Session->setFlash('The vote with id: '.$id.' is not deleted.');
        		$this->redirect(array('action' => 'index'));
        	}
        }
    }
	function edit($id = null) {
		$m = new MongoHelper();
		$collection = $m->connect($this->user, $this->pass);
		if (!empty($id)) {
			$doc = $collection->findOne(array('_id' => new MongoId($id)));
		} else {
			$id = $this->data['Vote']['id'];
			$doc = $collection->findOne(array('_id' => new MongoId($id)));
		}
		$this->set('vote', $doc);
        $username = $this->Session->read('user');
      	if (!$username) {
       		$this->redirect(array('controller' => 'users', 'action' => 'login'));
            return;
        }
        if ($username != $doc['owner']) {
        	$this->Session->setFlash('You can\'t edit other users\' votes.');
            $this->redirect(array('action' => 'index'));
        } else {
            if (empty($this->data)) {
            	return;
           	} else {
           		$doc['title'] = $this->data['Vote']['title'];
           		$doc['modified'] = date('Y-m-d');
           		$doc['voters'] = array();
           		$i = 0;
           		for ($i=1;;$i++) {
           			if (isset($this->data['Vote']['choice'.$i])) {
           				$doc['choice'.$i] = $this->data['Vote']['choice'.$i];
           				$doc['answer'.$i] = 0;
           			} else {
           				break;
           			}
           		}
           		$doc['choices'] = $i - 1;
           		$input = new InputHelper();
           		if (!$input->validate($doc)) {
           			$this->Session->setFlash('There are errors in your vote.');
           			return;
           		}
           		try {
                	$collection->update(array('_id' => new MongoId($id)), $doc, array('safe' => true));
                	$this->Session->setFlash('The vote with id: '.$id.' has been modified.');
                	$this->redirect(array('action' => 'index'));
           		} catch (MongoCursorException $e) {
           			$this->Session->setFlash('The vote with id: '.$id.' is not modified.');
           		}
            }
        }
    }
	function vote($id1, $id2) {
		$mongo = new MongoHelper();
		$collection = $mongo->connect($this->user, $this->pass);
		$vote = $collection->findOne(array('_id' => new MongoId($id1)));
		$username = $this->Session->read('user');
       	if (!$username) {
          	$this->redirect(array('controller' => 'users', 'action' => 'login'));
           	return;
        }
		$len = count($vote['voters']);
		$hasVoted = false;
		for ($i = 0; $i < $len; $i++) {
			if ($username === $vote['voters'][$i]) {
				$this->Session->setFlash('You can only vote once.');
				$this->redirect(array('action' => 'view', $id1));
				$hasVoted = true; 				
			}
		}
		if (!$hasVoted) {
			$vote['answer'.$id2] += 1;
			$vote['voters'][] = $username;
			try {
				$collection->update(array('_id' => new MongoId($id1)), $vote, array('safe' => true));
				$this->Session->setFlash('Your vote has been recorded.');
				$this->redirect(array('action' => 'view', $id1));
			} catch (MongoCursorException $e) {
				$this->Session->setFlash('Your vote is not recorded.');
			}
		}
	}
}
