<?php
require('../db_info.php');
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
mysql_select_db($db, $connect);
$query = "select id, owner, title, choice1, choice2, choice3, choice4 from votes";
$result = mysql_query($query);
$arr = array();
while ($obj = mysql_fetch_object($result)) {
        $arr[] = $obj;
}
echo '{"votes":'.json_encode($arr).'}';
// require('mongo_info.php');
// $mongo = new Mongo("mongodb://".$mongo_user.":".$mongo_pass."@dbh54.mongolab.com:27547/teamwiki");
// $mongodb = $mongo->teamwiki;
// $votes = $mongodb->votes;
// $cursor = $votes.find();
// $jsontext = "{votes:[";
// $data = array();
// while ($cursor.hasNext()) {
// 	$vote = $cursor.next();
// 	$item = array("_id" => $vote.get("_id")."", "title" => $vote.get("title"), "owner" => $vote.get("owner"), "voters" => $vote.get("voters"), "created" => $vote.get("created"), "modified" => $vote.get("modified"));
// 	for ($i = 0; $i < $vote.get("choices"); $i++) {
// 		$item["choice".($i+1)] = $vote.get("choice".($i+1));
// 		$item["answer".($i+1)] = $vote.get("answer".($i+1));
// 	}
// 	$item["choices"] = $vote.get("choices");
// 	$data[] = $item;
// }
// foreach ($data as $item) {
// 	$jsontext .= "{";
// 	foreach ($item as $key => $value) {
// 		$jsontext .= $key.":".$value.",";
// 	}
// 	$jsontext = substr_replace($jsontext, '', -1);
// 	$josntext .= "},";
// }
// $jsontext = substr_replace($jsontext, '', -1);
// $jsontext .= "]}";
// echo $jsontext;
?>