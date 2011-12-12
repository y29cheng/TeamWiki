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
<div id="child0" class="input textarea required">
<label for="VoteChoice1">Choice1</label>
<textarea name="data[Vote][choice1]" cols="30" rows="6" id="VoteChoice1" ></textarea>
</div>
<div id="child1" class="input textarea required">
<label for="VoteChoice2">Choice2</label>
<textarea name="data[Vote][choice2]" cols="30" rows="6" id="VoteChoice2" ></textarea>
</div>
</div>
<input type="button" value="Add another row" onclick="addInput('dynamicFields');">
<input type="button" value="Delete the last row" onclick="deleteInput('dynamicFields');" />
<?php
echo $this->Form->end('Save Vote');
?>
</body>
</html>
