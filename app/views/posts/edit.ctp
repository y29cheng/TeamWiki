<!-- File: /app/views/posts/edit.ctp -->
<script>
$("#posts").css("color", "#fff");
</script>
<?php
	echo $this->Form->create('Post', array('action' => 'edit'));
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('rows' => '3'));
	echo $this->Form->input('id', array('type' => 'hidden')); 
	echo $this->Form->end('Save Post');
?>

