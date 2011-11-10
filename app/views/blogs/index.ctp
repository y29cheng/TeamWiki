<!-- File: /app/views/blogs/index.ctp -->
<h1>Team Blogs</h1>
<?php echo $this->Html->link('Add Blog', array('controller' => 'blogs', 'action' => 'add')); ?>
<table>
	<tr>
		<th>Title</th>
		<th>Created</th>
		<th>Modified</th>
		
	</tr>

	<?php foreach ($blogs as $blog): ?>
	<tr>
		<td><?php echo $this->Html->link($blog['Blog']['title'], array('controller' => 'blogs', 'action' => 'view', $blog['Blog']['id'])); ?></td>
		<td><?php echo $blog['Blog']['created']; ?></td>
		<td><?php echo $blog['Blog']['modified']; ?></td>
		<td><?php echo $this->Html->link('Delete', array('action' => 'delete', $blog['Blog']['id']), null, 'Are you sure?') ?></td>
		<td><?php echo $this->Html->link('Edit', array('action' => 'edit', $blog['Blog']['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
