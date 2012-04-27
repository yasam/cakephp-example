<h3>Old sessions</h1>
<table class="sortable table table-striped">
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
<tfoot>
    <tr>
	<td colspan="7" style="text-align:center;">

<?php
	//Shows the page numbers
	echo $this->Paginator->numbers();
	//Shows the next and previous links
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	//prints X of Y, where X is current page and Y is number of pages
	echo $this->Paginator->counter(); 
?>
	</td>
    </tr>
</tfoot>
</table>
<?php
    echo $this->Html->link("Live sessions", 
		array('controller'=>'states', 'action'=>'index'),
		array('class' =>'btn btn-mini btn-info'));
?>
