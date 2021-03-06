<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $title_for_layout." | teamwiki.phpfogapp.com"; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
	<?php
        echo $this->Html->meta('icon');
        echo $this->Html->css(array('cake.generic', 'custom'));
        echo $scripts_for_layout;
		echo $javascript->link('clock.js');
    ?>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
    <script>
			var dojoConfig = (function() {
				var baseURL = location.href;
				var idx = baseURL.indexOf("://");
				var protocol = baseURL.substring(0, idx);
				baseURL = baseURL.substring(idx+3);
				baseURL = baseURL.split("/");
				baseURL = protocol + "://" + baseURL[0];
				return {
					async: true,
					isDebug: true,
					packages: [{
						name: "/", location: baseURL + "/" }, {
						name: "js", location: baseURL + "/js" }, {
						name: "templates", location: baseURL + "/templates" }]
				};
			})();
	</script>
	<script src="http://ajax.googleapis.com/ajax/libs/dojo/1.7.2/dojo/dojo.js" data-dojo-config="async: true"></script>
</head>
<body onload="clock(); setInterval('clock()', 1000)">
	<header>
		<h1>PeerVote - Voting Made Easier</h1>
	</header>
	<!--<nav>
			<ul>
				<li><a href="/posts/index" id="posts">Posts</a></li>
				<li><a href="/blogs/index" id="blogs">Blogs</a></li>
				<li><a href="/votes/index" id="votes">Votes</a></li>
				<li><?php if ($this->Session->check('user')) { 
						  	echo $this->Html->link('Log out', array('controller' => 'users', 'action' => 'logout', 'class' => 'none'), null, 'Are you sure?');
					 	  } else { ?>
							<a href="/users/login" id="login">Log in</a>
					<?php } ?></li>
				<?php if (!$this->Session->check('user')) { ?>
				<li><a href="/users/register" id="register">Register</a></li>
				<?php } ?>
				<li><a href="/resume.html">About Me</a></li>
				<?php if ($this->Session->check('user')) { ?>
					<li><a href="#" id="settings">Settings</a>
						<ul>
							<li><a href="/users/update_profile">Update Profile</a></li>
						</ul>
					</li>
				<?php } ?>
				<li><a href="#">Android App</a>
					<ul>
						<li><a href="/PeerVote.apk" class="none">Download</a></li>
					</ul>
				</li>
			</ul>
    </nav>-->
    <div id="panelBackground"></div>
    <div id="panelWidget"></div>
    <script>
    	require(["dojo/dom", "dojo/dom-style", "dojo/query", "dojo/_base/xhr", "dojo/_base/array", "js/tabWidget"], function(dom, domStyle, query, xhr, arrayUtil, tabWidget) {
    		var panelWidget = dom.byId("panelWidget");
			var def = xhr.get({
				url: "/menu.json",
				handleAs: "json"
			});
			def.then(function(menus) {
				arrayUtil.forEach(menus, function(menu) {
					var widget = new tabWidget({ tabName: menu.name, menuItems: menu.children, id: menu.id, url: menu.url }).placeAt(panelWidget);
				});
			});
			<?php if ($this->Session->check('user')) { ?>
			def.then(function() {
				panelWidget.childNodes[3].style.display="none";
				panelWidget.childNodes[5].style.display="none";
			});
			<?php } else { ?>
			def.then(function() {
				panelWidget.childNodes[4].style.display="none";
				panelWidget.childNodes[7].style.display="none";
			});
			<?php } ?>
			def.then(function() {
			<?php if ($this->params['controller'] == 'posts') { ?>
				domStyle.set(query("#post > a")[0], "color", "#fff");
			<?php } ?>
			<?php if ($this->params['controller'] == 'blogs') { ?>
				domStyle.set(query("#blog > a")[0], "color", "#fff");
			<?php } ?>
			<?php if ($this->params['controller'] == 'votes') { ?>
				domStyle.set(query("#vote > a")[0], "color", "#fff");
			<?php } ?>
			});
		});
	</script>
	<section>

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

	</section>
	<footer>
			<p><a href="http://www.mongodb.org"><img src="http://www.mongodb.org/download/attachments/132305/PoweredMongoDBgreen50.png?version=1&modificationDate=1247081595817" alt="powered by mongoDB" /></a></p>
			<p><span id="clock">&nbsp;</span></p>
    </footer>
</body>
</html>
