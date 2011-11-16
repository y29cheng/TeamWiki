<?php
require('../vendors/iredis.php');
$username = $_POST['username'];
$index = $_POST['index'];
$choice = $_POST['choice'];
$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
$len = $redis->llen('voters'.$index);
for ($i = 0; $i < $len; $i++) {
	if ($username === $redis->lindex('voters'.$index, $i)) {
		echo 'hasVoted';
		return;
	}
}
switch ($choice) {
case 1:
	$a1 = $redis->hget('vote'.$index, 'a1');
        $redis->hset('vote'.$index, 'a1', $a1 + 1);
        break;
case 2:
        $a2 = $redis->hget('vote'.$index, 'a2');
        $redis->hset('vote'.$index, 'a2', $a2 + 1);
        break;
case 3:
       	$a3 = $redis->hget('vote'.$index, 'a3');
        $redis->hset('vote'.$index, 'a3', $a3 + 1);
        break;
case 4:
        $a4 = $redis->hget('vote'.$index, 'a4');
        $redis->hset('vote'.$index, 'a4', $a4 + 1);
        break;
}
echo 'success';
?>

