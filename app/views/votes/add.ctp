<!-- File: /app/views/votes/add.ctp -->
<html>
<head>
<?php echo $javascript->link('myscript.js', false); ?>
</head>
<body>
<h1>Add Vote</h1>
<?php
echo $this->Form->create('Vote');
echo $this->Form->input('owner', array('type' => 'hidden'));
echo $this->Form->input('title');
?>
<div id="dynamicFields">
<?php
echo $this->Form->input('choice1');
echo $this->Form->input('choice2');
?>
</div>
<?php
echo $this->Form->button('Add Row', array('onclick' => "addInput('dynamicFields')"));
echo $this->Form->button('Delete Row', array('onclick' => "deleteInput('dynamicFields')"));
echo $this->Form->end('Save Vote');
?>
</body>
</html>
