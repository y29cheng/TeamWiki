<!-- File: /app/views/votes/view.ctp -->
<p><?php echo $vote['title']?></p>
<div id="choices">
<?php
$count = $vote['choices'];
for ($i=0;$i<$count;$i++) {
?>
<p value=<?php echo $vote['answer'.($i+1)]; ?>>
<?php echo $vote['answer'.($i+1)]; ?>&nbsp&nbsp&nbsp&nbsp
<?php echo $this->Html->link($vote['choice'.($i+1)], array('controller' => 'votes', 'action' => 'vote', $vote['_id'], $i+1)); ?>
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
