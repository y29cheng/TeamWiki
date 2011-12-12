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
<textarea name="data[Vote][choice1]" cols="30" rows="6" id="VoteChoice1" value="Enter choice1 here"></textarea>
<textarea name="data[Vote][choice2]" cols="30" rows="6" id="VoteChoice2" value="Enter choice2 here"></textarea>
<div id="dynamicFields"></div>
<button value="Add Row" onClick="addInput('dynamicFields')">
<button value="Delete Row" onClick="deleteInput('dynamicFields')">
<?php
echo $this->Form->end('Save Vote');
?>
</body>
</html>
