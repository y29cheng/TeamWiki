<!-- File: /app/views/votes/add.ctp -->

<h1>Add Vote</h1>
<?php
echo $this->Form->create('Vote');
echo $this->Form->input('owner', array('type' => 'hidden'));
echo $this->Form->input('title');
?>
<div class="input textarea required">
<textarea name="data[Vote][choice1]" cols="30" rows="6" id="VoteChoice1" value="Enter choice1 here"></textarea> 
</div>
<div class="input textarea required">
<textarea name="data[Vote][choice2]" cols="30" rows="6" id="VoteChoice2" value="Enter choice2 here"></textarea>
</div>
<div id="dynamicFields"></div>
<input type="button" value="Add Row" onClick="addInput('dynamicFields')">
<input type="button" value="Delete Row" onClick="deleteInput('dynamicFields')" />
<?php
echo $this->Form->end('Save Vote');
?>
