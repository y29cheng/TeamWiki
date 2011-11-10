<!-- File: /app/views/blogs/add.ctp -->

<h1>Add Blog</h1>
<?php
echo $this->Form->create('Blog');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Blog');
?>

