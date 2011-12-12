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
echo $this->Form->Button('add', array('value' => 'Add Row', onClick => "addInput('dynamicFields')"));
echo $this->Form->Button('delete', array('value' => 'Delete Row', onClick => "deleteInput('dynamicFields')"));
echo $this->Form->end('Save Vote');
?>
</body>
</html>
