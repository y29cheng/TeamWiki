<!-- File: /app/views/votes/add.ctp -->
<script>
$("#votes").css("color", "#fff");
</script>
<?php echo $javascript->link('myscript.js', false); ?>
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
