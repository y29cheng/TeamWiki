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
	<title>
		<?php echo $title_for_layout." | teamwiki.phpfogapp.com"; ?>
	</title>
	<?php
                echo $this->Html->meta('icon');

                echo $this->Html->css('cake.generic');

		echo $this->Html->css('custom');

                echo $scripts_for_layout;
		
		echo $javascript->link('clock.js');
        ?>
</head>
<body onload="clock(); setInterval('clock()', 1000)">
	<header>
		<h1>PeerVote - Voting Made Easier</h1>
	</header>
	<nav>
			<ul>
				<li><?php echo $this->Html->link('Posts', array('controller' => 'posts', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Blogs', array('controller' => 'blogs', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Votes', array('controller' => 'votes', 'action' => 'index')); ?></li>
				<li><?php if ($this->Session->check('user')) {
						echo $this->Html->link('Log Out', array('controller' => 'users', 'action' =>'logout'));
					  } else {
						echo $this->Html->link('Log in', array('controller' => 'users', 'action' => 'login'));
					  } ?></li>
				<?php if (!$this->Session->check('user')) { ?>
				<li><?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'register')); ?></li>
				<?php } ?>
				<li><a href="/resume.html">About Me</a></li>
				<?php if ($this->Session->check('user')) { ?>
					<li><?php echo $this->Html->link('Update Profile', array('controller' => 'users', 'action' => 'update_profile')); ?></li>
				<?php } ?>
				<li>Android App
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
