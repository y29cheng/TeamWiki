<!-- File: /app/views/votes/view.ctp -->
<?php App::import('Vendor', 'iredis'); ?>
<p><?php echo $vote['Vote']['title']?></p>
<p>
A. <?php echo $this->Html->link($vote['Vote']['choice1'], array('controller' => 'votes', 'action' => 'vote', $vote['Vote']['id'], 1)) ?>
</p>
<p>
B. <?php echo $this->Html->link($vote['Vote']['choice2'], array('controller' => 'votes', 'action' => 'vote', $vote['Vote']['id'], 2)) ?>
</p>
<p>
C. <?php echo $this->Html->link($vote['Vote']['choice3'], array('controller' => 'votes', 'action' => 'vote', $vote['Vote']['id'], 3)) ?>
</p>
<p>
D. <?php echo $this->Html->link($vote['Vote']['choice4'], array('controller' => 'votes', 'action' => 'vote', $vote['Vote']['id'], 4)) ?>
</p>
<p><a href="../../webroot/bar_chart.php">Show Result</a></p>
