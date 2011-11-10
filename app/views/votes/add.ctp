<!-- File: /app/views/votes/add.ctp -->

<h1>Add Vote</h1>
<?php
echo $this->Form->create('Vote');
echo $this->Form->input('title', array('rows' => '3'));
echo $this->Form->input('choice1');
echo $this->Form->input('choice2');
echo $this->Form->input('choice3');
echo $this->Form->input('choice4');
echo $this->Form->end('Save Vote');
?>
