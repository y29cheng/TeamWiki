<!-- File: /app/views/votes/add.ctp -->
<html>
<head>
<?php echo $javascript->link('myscript.js', false); ?>
</head>
<body>
<h1>Add Vote</h1>
<?php
echo $this->Form->create('Vote');
?>
<div id="dynamicFields">
<?php
echo $this->Form->input('title');
echo $this->Form->input('choice1');
echo $this->Form->input('choice2');
?>
</div>
<?php
echo $this->Form->button('Add Row', array('type' => 'button', 'onclick' => "addInput('dynamicFields')"));
echo $this->Form->button('Delete Row', array('type' => 'button', 'onclick' => "deleteInput('dynamicFields')"));
echo $this->Form->end('Save Vote');
?>
</body>
</html>
