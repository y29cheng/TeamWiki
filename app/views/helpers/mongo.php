<?php
class MongoHelper extends AppHelper {
	function connect() {
		$mongo = new Mongo("mongodb://georgeC:T3aMW1k14PP@staff.mongohq.com:10056/teamwiki");
		$mongodb = $mongo->teamwiki;
		$collection = $mongodb->votes;
		return $collection;
	}
} 
?>