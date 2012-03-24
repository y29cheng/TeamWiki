<!-- File: /app/views/votes/add.ctp -->
<script>
$("#votes").css("color", "#fff");
</script>
<?php echo $javascript->link('myscript.js', false); ?>
<?php
echo $this->Form->create('Vote');
$options = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 'forever');
echo $this->Form->input('expire', array('type' => 'select', 'label' => 'Expire in hours', 'options' => $options,  'default' => 12));
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
