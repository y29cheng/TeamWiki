<!-- File: /app/views/votes/index.ctp -->
<h1>Team Votes</h1>
<?php echo $this->Html->link('Add Vote', array('controller' => 'votes', 'action' => 'add')); ?>
<table>
        <tr>
                <th>Title</th>
		<th>Author</th>
                <th>Created</th>
                <th>Modified</th>

        </tr>

        <?php foreach ($votes as $vote): ?>
        <tr>
                <td><?php echo $this->Html->link($vote['Vote']['title'], array('controller' => 'votes', 'action' => 'view', $vote['Vote']['id'])); ?></td>
		<td><?php echo $vote['Vote']['owner']; ?></td>
                <td><?php echo $vote['Vote']['created']; ?></td>
                <td><?php echo $vote['Vote']['modified']; ?></td>
                <td><?php echo $this->Html->link('Delete', array('action' => 'delete', $vote['Vote']['id']), null, 'Are you sure?') ?></td>
                <td><?php echo $this->Html->link('Edit', array('action' => 'edit', $vote['Vote']['id'])); ?></td>
        </tr>
        <?php endforeach; ?>
</table>

