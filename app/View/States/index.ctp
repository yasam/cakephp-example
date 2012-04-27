<h3>Live Devices</h1>
<table class="sortable table table-striped">
<thead>
    <tr>
	<th>No</th>
	<th>Status</th>
	<th>Name</th>
	<th>Serial</th>
	<th>IP Addr.</th>
	<th>Session Start</th>
	<th>Duration(s)</th>
	<th>Actions</th>
    </tr>
</thead>
<tbody>
    <?php $cnt=1; foreach ($States as $State): ?>
    <tr>
	<td><?php echo $cnt++; ?></td>
        <td><?php echo $State['State']['status']; ?></td>
        <td><?php 
    		//echo $State['State']['name']; 
    		echo $this->Html->link($State['State']['name'], array('controller'=>'states', 'action'=>'index', 'name', $State['State']['name'])); 
    	?></td>
        <td><?php 
    		echo $this->Html->link($State['State']['serial'], array('controller'=>'states', 'action'=>'index', 'serial', $State['State']['serial'])); 
    		//echo $this->TB->link($State['State']['serial'], array('controller'=>'states', 'action'=>'index', 'serial', $State['State']['serial'])); 
    		//echo $this->TB->button_link($State['State']['serial'], "/states/index/serial/".$State['State']['serial'], array("style" => "info", "size" => "small"));
    		//echo $this->TB->button_link($State['State']['serial'], "/states/index/serial/".$State['State']['serial']);
    		//echo $this->TB->link($State['State']['serial'], "/states/index/serial/".$State['State']['serial']);
    	?></td>
        <td><?php echo $State['State']['ip']; ?></td>
        <td><?php echo $State['State']['ses_start']; ?></td>
        <td><?php 
    		$duration = date_diff(date_create(), date_create($State['State']['ses_start']));
    		//$out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
    		echo $duration->format("%H:%I:%S");
        
        ?></td>
        <td>
            <?php echo $this->Form->postLink(
                    'Close',
                    array('action' => 'close', $State['State']['id']),
                    array('class' =>'btn btn-mini btn-danger'),
                    'Are you sure?');
            ?>

        </td>
    </tr>
    <?php endforeach; ?>

</tbody>
</table>
<?php
    //echo $this->Html->link("Old sessions", array('controller'=>'states','action' => 'old'));

    echo $this->Html->link(
	    'Old Sessions',
	    array('controller' => 'states', 'action' => 'old'),
	    array('class' =>'btn btn-mini btn-info')
	);
/*
    echo $this->TB->button_link(
	    'Old Sessions',
	    array('controller' => 'states', 'action' => 'old'),
	    array("style" => "info", "size" => "mini")
	);
*/
?>

