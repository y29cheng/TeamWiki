<?php
App::import('Helper', 'mongo');
// require('db_info.php');
// $connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
// mysql_select_db($db, $connect);
$m = new MongoHelper();
$collection = $m->connect("georgeC", "T3aMW1k14PP");
$votes = $collection.find();
// $query = "select id, owner, title, choice1, choice2, choice3, choice4 from votes";
// $result = mysql_query($query);
// $arr = array();
// while ($obj = mysql_fetch_object($result)) {
//         $arr[] = $obj;
// }
echo '{"votes":'.bson_encode($votes).'}';
?>

