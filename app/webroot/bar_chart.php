<?php
$mongo = new Mongo("mongodb://georgeC:T3aMW1k14PP@staff.mongohq.com:10056/teamwiki");
$mongodb = $mongo->teamwiki;
$collection = $mongodb->votes;
$vote = $collection.findOne(array('_id' => new MongoId($id)));
$values = array();
for ($i=0;$i<$vote['choices'];$i++) { 
	$values['choice'.($i+1)] = $vote['answer'.($i+1)];
}
$img_width = 450;
$img_height = 300;
$margins = 20;
$graph_width = $img_width - $margins * 2;
$graph_height = $img_height - $margins * 2;
$img = imagecreate($img_width, $img_height);

$bar_width = 20;
$total_bars = count($values);
$gap = ($graph_width - $bar_width * $total_bars) / ($total_bars + 1);
$bar_color = imagecolorallocate($img, 0, 64, 128);
$background_color = imagecolorallocate($img, 240, 240, 255);
$border_color = imagecolorallocate($img, 200, 200, 200);
$line_color = imagecolorallocate($img, 220, 220, 220);
imagefilledrectangle($img, 1, 1, $img_width - 2, $img_height - 2, $border_color);
imagefilledrectangle($img, $margins, $margins, $img_width - 1 - $margins, $img_height - 1 - $margins, $background_color);
$max_value = max($values);
if ($max_value == 0) {
	$ratio = 0;
} else {
	$ratio = $graph_height / $max_value;
}
/*$horizontal_lines=20;
$horizontal_gap=$graph_height/$horizontal_lines;
for($i=1;$i<=$horizontal_lines;$i++){
	$y=$img_height - $margins - $horizontal_gap * $i ;
	imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
	$v=intval($horizontal_gap * $i /$ratio);
	imagestring($img,0,5,$y-5,$v,$bar_color);
}*//* Use this when vote number gets bigger */
/* Draw the bars */
for ($i = 0; $i < $total_bars; $i++) {
	list($key, $value) = each($values);
	$x1 = $margins + $gap + $i * ($bar_width + $gap);
	$x2 = $x1 + $bar_width;
	$y1 = $margins + $graph_height - intval($value * $ratio);
	$y2 = $img_height - $margins;
	imagefilledrectangle($img, $x1, $y1, $x2, $y2, $bar_color);
	imagestring($img, 0, $x1 + 3, $y1 - 10, $value, $bar_color);
	imagestring($img, 0, $x1 + 3, $img_height - 15, $key, $bar_color);
}
header("Content-type:image/png");
imagepng($img);
?>
