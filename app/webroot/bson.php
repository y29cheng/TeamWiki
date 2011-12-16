<?php
require('mongo_info.php');
// $connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
// mysql_select_db($db, $connect);
$mongo = new Mongo("mongodb://".$mongo_user.":".$mongo_pass."@staff.mongohq.com:10056/teamwiki");
$mongodb = $mongo->teamwiki;
$collection = $mongodb->votes;
$votes = $collection.find();
// $query = "select id, owner, title, choice1, choice2, choice3, choice4 from votes";
// $result = mysql_query($query);
// $arr = array();
// while ($obj = mysql_fetch_object($result)) {
//         $arr[] = $obj;
// }
echo '{"votes":'.bson_encode($votes).'}';
?>

