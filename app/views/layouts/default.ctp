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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
	<!--Script to tame the IE6 beast-->
	<script>
	// Javascript originally by Patrick Griffiths and Dan Webb.
	// http://htmldog.com/articles/suckerfish/dropdowns/
	sfHover = function() {
	   var sfEls = document.getElementById("navbar").getElementsByTagName("li");
	   for (var i=0; i<sfEls.length; i++) {
	      sfEls[i].onmouseover=function() {
		 this.className+=" hover";
	      }
	      sfEls[i].onmouseout=function() {
		 this.className=this.className.replace(new RegExp(" hover\\b"), "");
	      }
	   }
	}
	if (window.attachEvent) window.attachEvent("onload", sfHover);
	</script>
</head>
<body onload="clock(); setInterval('clock()', 1000)">
	<div id="container">
		<div id="header">
			<ul id="navbar">
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
				<li><a href="http://teamwiki.phpfogapp.com/resume.html">About Me</a></li>
				<?php if ($this->Session->check('user')) { ?>
				<li><a href="#">Setting</a><ul>
					<li><?php echo $this->Html->link('Change Password', array('controller' => 'user', 'action' => 'change_password')); ?></li></ul>
				</li>
				<?php } ?>
			</ul>
                </div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<p>current time: <span id="clock">&nbsp;</span></p>
                </div>

	</div>
</body>
</html>
