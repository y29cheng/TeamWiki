<!-- File: /app/views/votes/view.ctp -->
<script>
$("#votes").css("color", "#fff");
</script>
<?php
$time = time();
$hours = $vote['expire'] + 1;
$expired = false;
if ($time - $vote['time'] > 3600*$hours && $hours < 25) {
	$expired = true;
?>
	<p>This vote has expire. You can still see the result below.</p>
<?php
}
?>
<p><?php echo $vote['title']?></p>
<div id="choices">
<?php
$count = $vote['choices'];
for ($i=0;$i<$count;$i++) {
?>
<p value=<?php echo $vote['answer'.($i+1)]; ?>>
<?php echo $vote['answer'.($i+1)]; ?>&nbsp&nbsp&nbsp&nbsp
<?php
if (!$expired) { 
	echo $this->Html->link($vote['choice'.($i+1)], array('controller' => 'votes', 'action' => 'vote', $vote['_id'], $i+1)); 
} else {
	echo $vote['choice'.($i+1)];
}
?>
</p>
<?php } ?>
</div>
<!--<canvas id="bar_graph"></canvas>-->
<script type="text/javascript" src="/js/barGraph.js"></script>
<script>
var ctx = document.getElementById("bar_graph").getContext("2d");
var graph = new BarGraph(ctx);
var div = document.getElementById('choices');
var links = div.getElementsByTagName('p');
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
