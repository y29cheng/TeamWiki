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
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js">
    </script>
    <script type="text/javascript" src="/js/custom.js">
    </script>
</head>
<body onload="clock(); setInterval('clock()', 1000)">
	<header>
		<h1>PeerVote - Voting Made Easier</h1>
	</header>
	<nav>
			<ul>
				<li><a href="/posts/index">Posts</a></li>
				<li><a href="/blogs/index">Blogs</li>
				<li><a href="/votes/index">Votes</a></li>
				<li><?php if ($this->Session->check('user')) { ?>
						<a href="/users/login">Log in</a>
					  } else { ?>
						<a href="/users/logout">Log out</a>
					  } ?></li>
				<?php if (!$this->Session->check('user')) { ?>
				<li><a href="/users/register">Register</a></li>
				<?php } ?>
				<li><a href="/resume.html">About Me</a></li>
				<?php if ($this->Session->check('user')) { ?>
					<li><a href="/">Settings</a>
						<ul>
							<li><?php echo $this->Html->link('Update Profile', array('controller' => 'users', 'action' => 'update_profile')); ?></li>
						</ul>
					</li>
				<?php } ?>
				<li><a href="/">Android App</a>
					<ul>
						<li><a href="/PeerVote.apk">Download</a></li>
					</ul>
				</li>
			</ul>
    </nav>
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
