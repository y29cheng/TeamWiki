<!-- File: /app/views/votes/edit.ctp -->
<html>
<head>
<?php echo $javascript->link('myscript.js', false); ?>
</head>
<body>
<h1>Edit Vote</h1>
<?php
echo $this->Form->create('Vote');
echo $this->Form->input('owner', array('type' => 'hidden', 'value' => $vote['owner']));
?>
<div id="dynamicFields">
<?php
echo $this->Form->input('title', array('value' => $vote['title']));
for ($i=0;$i<$vote['choices'];$i++) {
	echo $this->Form->input('choice'.($i+1), array('type' => 'textarea', 'value' => $vote['choice'.($i+1)]));
}
?>
</div>
<?php
echo $this->Form->button('Add Row', array('type' => 'button', 'onclick' => "addInput('dynamicFields')"));
echo $this->Form->button('Delete Row', array('type' => 'button', 'onclick' => "deleteInput('dynamicFields')"));
echo $this->Form->end('Save Vote');
?>
</body>
</html>

