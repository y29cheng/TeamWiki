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
</head>
<body onload="clock(); setInterval('clock()', 1000)">
	<div id="container">
		<div id="header">
			<ul id="horizontal">
				<li><?php echo $this->Html->link('Posts', array('controller' => 'posts', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Blogs', array('controller' => 'blogs', 'action' => 'index')); ?></li>
				<li><?php if ($this->Session->check('user')) {
						echo $this->Html->link('Log Out', array('controller' => 'users', 'action' =>'login'));
					  } else {
						echo $this->Html->link('Log in', array('controller' => 'posts', 'action' => 'index'));
					  } ?></li>
			</ul>
                </div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<span id="clock">&nbsp;</span>
		<div id="footer">
                        <?php echo $this->Html->link(
                                        $this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
                                        'http://www.cakephp.org/',
                                        array('target' => '_blank', 'escape' => false)
                                );
                        ?>
                </div>

	</div>
</body>
</html>
