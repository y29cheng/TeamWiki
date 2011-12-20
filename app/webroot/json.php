<?php
require('../db_info.php');
// $connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
// mysql_select_db($db, $connect);
// $query = "select id, owner, title, choice1, choice2, choice3, choice4 from votes";
// $result = mysql_query($query);
// $arr = array();
// while ($obj = mysql_fetch_object($result)) {
//         $arr[] = $obj;
// }
// echo '{"votes":'.json_encode($arr).'}';
$url='https://api.mongolab.com/api/1/databases/teamwiki/collections/votes?apiKey='.$apiKey; //api link for mongolab json
print_r(get_data($url)); //dumps the content, you can manipulate as you wish to

/* gets the data from a URL */

function get_data($url)
{
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
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