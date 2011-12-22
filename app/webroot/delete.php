<?php
require('../db_info.php');
// require('../vendors/iredis.php');
// $id = $_POST['id'];
// $connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
// mysql_select_db($db, $connect);
// $query = "delete from votes where id='$id'";
// $result = mysql_query($query);
// $redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
// $redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6');
// $redis->del('vote'.$id);
// $redis->del('voters'.$id);
// if ($result) {
// 	echo 1;
// } else {
// 	echo 0;
// }
$id = $_POST['id'];
$m = new Mongo("mongodb://".$mongo_user.":".$mongo_pass."@dbh54.mongolab.com:27547/teamwiki");
$db = $m->teamwiki;
$votes = $db->votes;
try {
	$votes->remove(array('_id' => new MongoId($id)), array('safe' => true));
	echo "success";
} catch (Exception $e) {
	echo "error";
}
?>
