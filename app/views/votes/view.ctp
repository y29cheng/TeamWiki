<!-- File: /app/views/votes/view.ctp -->
<p><?php echo $vote['title']?></p>
<?php
$count = $vote['choices'];
for ($i=0;$i<$count;$i++) {
?>
<p>
<?php echo $vote['answer'.($i+1)]; ?>&nbsp&nbsp&nbsp&nbsp
<?php echo $this->Html->link($vote['choice'.($i+1)], array('controller' => 'votes', 'action' => 'vote', $vote['_id'], $i+1)); ?>
</p>
<?php } ?>

<form method="post" action="http://teamwiki.phpfogapp.com/bar_chart.php">
<input type="hidden" name="id" value="2">
<input type="submit" value="Show Result">