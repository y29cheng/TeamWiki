<!-- File: /app/views/votes/view.ctp -->
<p><?php echo $vote['title']?></p>
<?php
$count = $vote['choices'];
for ($i=0;$i<$count;$i++) {
?>
<p>
<?php echo $vote['answer'.($i+1)]; ?>&nbsp&nbsp&nbsp&nbsp
<?php echo $this->Html->link($vote['choice'.($i+1)], array('value' => $vote['answer'.($i+1)], 'controller' => 'votes', 'action' => 'vote', $vote['_id'], $i+1)); ?>
</p>
<?php } ?>
<canvas id="bar_graph"></canvas>
<?php echo $javascript->link('barGraph.js', false); ?>
<script>
var ctx = document.getElementById('bar_graph').getContext('2d');
var graph = new BarGraph(ctx);
var div = document.getElementById('content');
var links = div.getElementsByTagName('a');
var nbr = links.length;
var arr = new Array();
graph.margin = 2;
graph.width = 450;
graph.height = 150;
for (var i = 0; i < nbr; i++) {
	graph.xAxisLabelArr[i] = "Choice" + (i + 1);
	arr[i] = links[i].getAttribute('value');
}
graph.update(arr);
</script>
<!--<form method="post" action="http://teamwiki.phpfogapp.com/bar_chart.php">
<input type="hidden" name="id" value=<?php echo $id ?>>
<input type="submit" value="Show Result">-->