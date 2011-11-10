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
<p>Poll:</p>
<?php 
$redis = new iRedis(array('hostname' => '50.30.35.9', 'port' => 2117));
$redis->auth('f0493aeaecd8799a1ecdb5ca9193e0e6'); 
$id = $vote['Vote']['id'];
?>
<p>A. <?php echo $redis->hget('vote'.$id, 'a1'); ?></p>
<p>B. <?php echo $redis->hget('vote'.$id, 'a2'); ?></p>
<p>C. <?php echo $redis->hget('vote'.$id, 'a3'); ?></p>
<p>D. <?php echo $redis->hget('vote'.$id, 'a4'); ?></p>
