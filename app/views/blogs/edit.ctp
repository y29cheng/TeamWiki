<!-- File: /app/views/blogs/edit.ctp -->

<h1>Edit Blog</h1>
<?php
        echo $this->Form->create('Blog', array('action' => 'edit'));
        echo $this->Form->input('title');
        echo $this->Form->input('body', array('rows' => '3'));
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->end('Save Blog');
?>

