<!-- File: /app/views/posts/add.ctp -->
<script>
$("#posts").css("color", "#fff");
</script>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('name', array('type' => 'hidden')); 
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
?>
