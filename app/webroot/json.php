<?php
require('db_info.php');
$connect = mysql_connect($host, $user, $pass) or die ("unable to connect to ".$host);
mysql_select_db($db, $connect);
$query = "select id, title, choice1, choice2, choice3, choice4 from votes";
$result = mysql_query($query);
$arr = array();
while ($obj = mysql_fetch_object($result)) {
        $arr[] = $obj;
}
echo '{"votes":'.json_encode($arr).'}';
?>

