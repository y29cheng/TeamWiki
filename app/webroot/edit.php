<?php
require('../db_info.php');
$id = $_POST['id'];
$counter = intval($_POST['counter']);
$obj = array();
$obj['owner'] = $_POST['owner'];
$obj['expire'] = $_POST['expire'];
$obj['time'] = $_POST['time'];
$obj['voters'] = array();
for ($i = 0; $i < $counter; $i++) {
	if ($i == 0) {
		$obj['title'] = $_POST['title'];
	} else {
		$obj['choice'.$i] = $_POST['choice'.$i];
		$obj['answer'.$i] = 0;
	}
}
$obj['created'] = $_POST['created'];
$obj['modified'] = date("Y-m-d", time());
$obj['choices'] = $counter - 1;
$m = new Mongo("mongodb://".$mongo_user.":".$mongo_pass."@dbh54.mongolab.com:27547/teamwiki");
$db = $m->teamwiki;
$votes = $db->votes;
try {
	$votes->update(array('_id' => new MongoId($id)), $obj, array('safe' => true));
	echo "success";
} catch (Exception $e) {
	echo "failure";
}
// $connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
// $id = mysql_real_escape_string($_POST['id'], $connect);
// $owner = mysql_real_escape_string($_POST['owner'], $connect);
// $title = mysql_real_escape_string($_POST['title'], $connect);
// $choice1 = mysql_real_escape_string($_POST['choice1'], $connect);
// $choice2 = mysql_real_escape_string($_POST['choice2'], $connect);
// $choice3 = mysql_real_escape_string($_POST['choice3'], $connect);
// $choice4 = mysql_real_escape_string($_POST['choice4'], $connect);
// $modified = date("Y-m-d", time());
// mysql_select_db($db, $connect);
// $query = "update votes set title='$title', choice1='$choice1', choice2='$choice2', choice3='$choice3', choice4='$choice4', modified='$modified' where id='$id'";
// $result = mysql_query($query);
// if ($result) {
// 	echo 1;
// } else {
// 	echo 0;
// }
?>
