<!-- File: /app/views/votes/edit.ctp -->
<script>
$("#votes").css("color", "#fff");
</script>
<?php echo $javascript->link('myscript.js', false); ?>
<?php
echo $this->Form->create('Vote');
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $vote['_id'].""));
$options = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 'forever');
if (array_key_exists('expire', $vote)) echo $this->Form->input('expire', array('type' => 'select', 'label' => 'Expire in hours' , 'options' => $options, 'default' => $vote['expire']));
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

