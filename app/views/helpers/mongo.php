<?php
class MongoHelper extends AppHelper {
	function connect($username, $password) {
		$mongo = new Mongo("mongodb://".$username.":".$password."@staff.mongohq.com:10056/teamwiki");
		$mongodb = $mongo->teamwiki;
		$collection = $mongodb->votes;
		return $collection;
	}
} 
?>