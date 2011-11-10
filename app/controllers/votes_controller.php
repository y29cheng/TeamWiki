<?php
App::import('Vendor', 'iredis');
class VotesController extends AppController {
	public $helpers = array('Html', 'Form', 'Javascript');
	public $name = 'votes';
	function index() {
		$username = $this->Session->read('user');
                if ($username) {
                        $this->set('votes', $this->Vote->find('all'));
                } else {
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                }
        }
	function view($id = null) {
                $this->Vote->id = $id;
                $this->set('vote', $this->Vote->read());
        }
	function add() {
                $username = $this->Session->read('user');
                if ($username !== 'admin') {
                        $this->Session->setFlash('Only the admin can add votes');
                        $this->redirect(array('action' => 'index'));
                } else {
                        if (!empty($this->data)) {
                                if ($this->Vote->save($this->data)) {
					$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
					$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
					$redis->incr('id');
					$tmp = $redis->get('id');
					$redis->hset('vote'.$tmp, 'a1', 0);
					$redis->hset('vote'.$tmp, 'a2', 0);
					$redis->hset('vote'.$tmp, 'a3', 0);
					$redis->hset('vote'.$tmp, 'a4', 0);
					$redis->lpush('voters'.$tmp, 'admin');
                                        $this->Session->setFlash('Your vote has been saved.');
					$this->redirect(array('action' => 'index'));
                                }
                        } else {
                                        $this->Session->setFlash('Empty vote is not allowed.');
                        }
                }
        }
	function delete($id) {
                $blog = $this->Vote->findById($id);
                $username = $this->Session->read('user');
                if ($username !== 'admin') {
                        $this->Session->setFlash('Only the admin can delete votes');
                        $this->redirect(array('action' => 'index'));
                } else {
                        $this->Vote->delete($id);
			$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
			$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
			$redis->del('vote'.$id);
			$redis->del('voters'.$id);
                        $this->Session->setFlash('The vote with id: '.$id.' has been deleted.');
                        $this->redirect(array('action' => 'index'));
                }
        }
	function edit($id = null) {
                $blog = $this->Vote->findById($id);
                $username = $this->Session->read('user');
                if ($username !== 'admin') {
                        $this->Session->setFlash('Only the admin can edit votes');
                        $this->redirect(array('action' => 'index'));
                } else {
                        if (empty($this->data)) {
                                $this->data = $this->Vote->read();
                        } else {
                                $this->Vote->save($this->data);
                                $this->Session->setFlash('The vote with id: '.$id.' has been modified.');
                                $this->redirect(array('action' => 'index'));
                        }
                }
        }
	function vote($id1, $id2) {
		$username = $this->Session->read('user');
		$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
		$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
		$len = $redis->llen('voters'.$id1);
		$hasVoted = FALSE;
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
			$this->redirect(array('action' => 'view', $id1));
		}
	}
}
