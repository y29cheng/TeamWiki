<?php
class MongoHelper extends AppHelper {
	function connect($username, $password) {
		$mongo = new Mongo("mongodb://".$username.":".$password."@dbh54.mongolab.com:27547/teamwiki");
		$mongodb = $mongo->teamwiki;
		$collection = $mongodb->votes;
		return $collection;
	}
} 
?>