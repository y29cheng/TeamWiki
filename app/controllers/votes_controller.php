<?php
App::import('Vendor', 'iredis');
App::import('Helper', 'Input');
App::import('Helper', 'Mongo');
class VotesController extends AppController {
	public $helpers = array('Html', 'Form', 'Javascript', 'Input', 'Mongo');
	public $name = 'votes';
	function index() {
		$username = $this->Session->read('user');
        	if ($username) {
        		$m = new MongoHelper();
                $collection = $m->connect();
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
        $collection = $m->connect();
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
			$obj['created'] = date('Y-m-d');
			$obj['modified'] = $obj['created'];
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
            $collection = $m->connect();
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
		$collection = $m->connect();
    	$vote = $collection->findOne(array('_id' => new MongoId($id)));
        $username = $this->Session->read('user');
        if (!$username) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        	return;
        }
        if ($username != $vote['owner']."") {
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
		$collection = $m->connect();
		if (!empty($id)) {
			$doc = $collection->findOne(array('_id' => new MongoId($id)));
		} else {
			$doc = $collection->findOne(array('_id' => new MongoId($this->data['Vote']['id'])));
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
           		$input = new InputHelper();
           		if (!$input->validate($this->data)) {
           			$this->Session->setFlash('There are errors in your vote.');
           			return;
           		}
           		$doc['title'] = $this->data['title'];
           		$doc['modified'] = date('Y-m-d');
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
		$vote = $this->Vote->findById($id1);
		$username = $this->Session->read('user');
       	if (!$username) {
          	$this->redirect(array('controller' => 'users', 'action' => 'login'));
           	return;
        }
		$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
		$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
		$len = $redis->llen('voters'.$id1);
		$hasVoted = FALSE;
		if ($username === $vote['Vote']['owner']) {
			$this->Session->setFlash('You created this vote.');
			$this->redirect(array('action' => 'view', $id1));
			return;
		}
		for ($i = 0; $i < $len; $i++) {
			if ($username === $redis->lindex('voters'.$id1, $i)) {
				$this->Session->setFlash('You can only vote once.');
				$this->redirect(array('action' => 'view', $id1));
				$hasVoted = TRUE; 				
			}
		}
		if (!$hasVoted) {
			switch ($id2) {
			case 1:
				$a1 = $redis->hget('vote'.$id1, 'a1');
				$redis->hset('vote'.$id1, 'a1', $a1 + 1);
				$redis->lpush('voters'.$id1, $username);
				break;
			case 2:
            	$a2 = $redis->hget('vote'.$id1, 'a2');
                $redis->hset('vote'.$id1, 'a2', $a2 + 1);
				$redis->lpush('voters'.$id1, $username);
                break;
			case 3:
                $a3 = $redis->hget('vote'.$id1, 'a3');
                $redis->hset('vote'.$id1, 'a3', $a3 + 1);
				$redis->lpush('voters'.$id1, $username);
                break;
			case 4:
                $a4 = $redis->hget('vote'.$id1, 'a4');
                $redis->hset('vote'.$id1, 'a4', $a4 + 1);
				$redis->lpush('voters'.$id1, $username);
                break;
			}
			$this->Session->setFlash('Your vote has been recorded.');
			$this->redirect(array('action' => 'view', $id1));
		}
	}
}
