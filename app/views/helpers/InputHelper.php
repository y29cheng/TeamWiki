<?php
class InputHelper extends AppHelper {
	function validate($obj) {
		if (empty($obj)) return false;
		if (!isset($obj['title']) || empty($obj['title'])) return false;
		if (!isset($obj['owner']) || empty($obj['owner'])) return false;
		if (!isset($obj['created']) || empty($obj['created'])) return false;
		if (!isset($obj['modified']) || empty($obj['modified'])) return false;
		for ($i=1;;$i++) {
			if (!isset($obj['choice'.$i])) break;
			if (empty($obj['choice'.$i])) return false;  
		}
		return true;
	}
}
?>