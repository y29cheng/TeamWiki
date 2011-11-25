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
<?php
echo $this->Form->create(null, array('url' => 'http://teamwiki.phpfogapp.com/bar_chart.php'));
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $vote['Vote']['id']));
echo $this->Form->end('Show Result');
?>
