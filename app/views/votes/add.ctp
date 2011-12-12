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
echo $this->Form->input('choice1');
echo $this->Form->input('choice2');
?>
<div id="dynamicFields"></div>
<?php
echo $this->Form->Button('Add Row', array('type' => 'button', 'id' => 'add', 'value' => 'Add Row'));
echo $this->Form->Button('Delete Row', array('type' => 'button', id' => 'delete', 'value' => 'Delete Row'));
echo $this->Form->end('Save Vote');
?>
</body>
</html>
