<!-- File: /app/views/posts/index.ctp -->
<?php echo 'Your logged in as ' . $this->Session->read('user') . '. Welcome!' ?>
<?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add')); ?>
<table>
	<tr>
		<th>Name</th>
		<th>Title</th>
		<th>Created</th>
		<th>Modified</th>
	</tr>

	<!-- Here is where we loop through our $posts array, printing out post info -->

	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['name']; ?></td>
		<td>
			<?php echo $this->Html->link($post['Post']['title'], 
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
		</td>
		<td><?php echo $post['Post']['created']; ?></td>
		<td><?php echo $post['Post']['modified']; ?></td>
		<td><?php echo $this->Html->link('Delete', array('action'=>'delete', $post['Post']['id']), null, 'Are you sure?') ?></td>
		<td><?php echo $this->Html->link('Edit', array('action'=>'edit', $post['Post']['id'])); ?></td>
	</tr>
	<?php endforeach; ?>

</table>
