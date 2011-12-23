<?php
// require('../vendors/iredis.php');
require('../db_info.php');
$username = $_POST['username'];
$index = $_POST['index'];
$choice = $_POST['choice'];
$m = new Mongo("mongodb://".$mongo_user.":".$mongo_pass."@dbh54.mongolab.com:27547/teamwiki");
$db = $m->teamwiki;
$votes = $db->votes;
$vote = $votes->findOne(array('_id' => new MongoId($index)));
$voters = $vote['voters'];
$voters[] = $username;
try {
	$votes->update(array('_id' => new MongoId($index)), array('$inc' => array('answer'.$choice => 1), '$set' => array('voters' => $voters)), array('safe' => true));
	echo "success";
} catch (Exception $e) {
	echo "error";
}
// $redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
// $redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
// $len = $redis->llen('voters'.$index);
// for ($i = 0; $i < $len; $i++) {
// 	if ($username === $redis->lindex('voters'.$index, $i)) {
// 		echo 'hasVoted';
// 		return;
// 	}
// }
// switch ($choice) {
// case 1:
// 	$a1 = $redis->hget('vote'.$index, 'a1');
//         $redis->hset('vote'.$index, 'a1', $a1 + 1);
// 	$redis->lpush('voters'.$index, $username);
//         break;
// case 2:
//         $a2 = $redis->hget('vote'.$index, 'a2');
//         $redis->hset('vote'.$index, 'a2', $a2 + 1);
// 	$redis->lpush('voters'.$index, $username);
//         break;
// case 3:
//        	$a3 = $redis->hget('vote'.$index, 'a3');
//         $redis->hset('vote'.$index, 'a3', $a3 + 1);
// 	$redis->lpush('voters'.$index, $username);
//         break;
// case 4:
//         $a4 = $redis->hget('vote'.$index, 'a4');
//         $redis->hset('vote'.$index, 'a4', $a4 + 1);
// 	$redis->lpush('voters'.$index, $username);
//         break;
// }
// echo 'success';
?>