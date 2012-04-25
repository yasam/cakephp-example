<h1>Users</h1>
<table class="sortable">
<thead>
    <tr>
	<th>No</th>
	<th>User Name</th>
	<th>Name</th>
	<th>E-Mail</th>
	<th>Role</th>
<?php
if($this->Tool->isVisible($sessionUser))
{
?>
		<th>Actions</th>
<?php
}
?>
    </tr>
</thead>
<tbody>
    <!-- Here is where we loop through our $services array, printing out service info -->

    <?php $cnt=1; foreach ($users as $user): 
		if($sessionUser['id'] == $user['User']['id'])
			continue;
		?>
    <tr>
	<td><?php echo $cnt++;?></td>
        <td><?php echo $user['User']['username']; ?></td>
		<td><?php echo $user['User']['name']; ?></td>
		<td><?php echo $user['User']['email']; ?></td>
        <td><?php echo $user['User']['role']; ?></td>
<?php
if($this->Tool->isVisible($sessionUser))
{
?>
        <td class="actions">
    	    <?php echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $user['User']['id']),
                    array('confirm' => 'Are you sure?'));
            ?>
    	    <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']));?>
        </td>
<?php
}
?>
    </tr>
    <?php endforeach; ?>

</tbody>
</table>
<?php
if($this->Tool->isVisible($sessionUser))
{
    echo '<div class="actions">';
    echo $this->Html->link('Add User', array('controller' => 'users', 'action' => 'add'));
    echo '</div>';
}
?>
