<h1>Connected Devices</h1>
<table class="sortable">
<thead>
    <tr>
	<th>No</th>
	<th>Status</th>
	<th>Name</th>
	<th>Serial</th>
	<th>IP Addr.</th>
	<th>Session Start</th>
	<th>Session End</th>
    </tr>
</thead>
<tbody>
    <?php $cnt=1; foreach ($States as $State): ?>
    <tr>
	<td><?php echo $cnt++; ?></td>
        <td><?php echo $State['State']['status']; ?></td>
        <td><?php echo $State['State']['name']; ?></td>
        <td><?php echo $State['State']['serial']; ?></td>
        <td><?php echo $State['State']['ip']; ?></td>
        <td><?php echo $State['State']['ses_start']; ?></td>
        <td><?php echo $State['State']['ses_end']; ?></td>
    </tr>
    <?php endforeach; ?>

</tbody>
</table>
