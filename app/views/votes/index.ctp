<!-- File: /app/views/votes/index.ctp -->
<script>
var links = "nav a";
$(links[2]).attr("class", "selected");
</script>
<?php echo $this->Html->link('Add Vote', array('controller' => 'votes', 'action' => 'add')); ?>
<table id="mytable">
        <tr value="-1">
                <th>Title</th>
		<th>Author</th>
                <th>Created</th>
                <th>Modified</th>

        </tr>

        <?php foreach ($votes as $vote): ?>
        <tr>
                <td><?php echo $this->Html->link($vote['title'], array('controller' => 'votes', 'action' => 'view', $vote['_id'])); ?></td>
		<td><?php echo $vote['owner']; ?></td>
                <td><?php echo $vote['created']; ?></td>
                <td><?php echo $vote['modified']; ?></td>
                <td><?php echo $this->Html->link('Delete', array('action' => 'delete', $vote['_id']), null, 'Are you sure?') ?></td>
                <td><?php echo $this->Html->link('Edit', array('action' => 'edit', $vote['_id'])); ?></td>
        </tr>
        <?php endforeach; ?>
</table>

