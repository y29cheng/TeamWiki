<!-- File: /app/views/votes/edit.ctp -->

<h1>Edit Vote</h1>
<?php
echo $this->Form->create('Vote', array('action' => 'edit'));
echo $this->Form->input('title', array('rows' => '3'));
echo $this->Form->input('choice1');
echo $this->Form->input('choice2');
echo $this->Form->input('choice3');
echo $this->Form->input('choice4');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Vote');
?>

