<h3>Active Connections</h1>
<table class="sortable table table-striped">
<?php

if (count($States) > 0)
{

?>
<thead>
    <tr>
	<th>No</th>
	<th>Status</th>
	<th>Name</th>
	<th>Serial</th>
	<th>IP Addr.</th>
	<th>Session Start</th>
	<th>Duration</th>
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
        $end = date_create(); 
    		$duration = date_diff($end, date_create($State['State']['ses_start']));
    		//$out = $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
    		echo $duration->format("%H:%I:%S");
        //echo date("-H:i:s");
        
        ?></td>
        <td>
            <?php echo $this->Form->postLink(
                    'Close',
                    array('action' => 'close', $State['State']['id']),
                    array('class' =>'btn btn-mini btn-danger'),
                    'Are you sure?');
            ?>
            <?php
                if($State['State']['status'] == 'SUBSCRIBED')
                {
                    echo $this->Html->link(
                        'Add',
                        array('controller'=>'devices','action' => 'add', $State['State']['id']),
                        array('class' =>'btn btn-mini btn-primary'));
                }
            ?>

        </td>
    </tr>
    <?php endforeach; ?>

</tbody>
</table>
<?php
}
else
{
  echo '<div class="alert alert-warning">There is no active connection.</div>';
}
?>
<?php
    //echo $this->Html->link("Old sessions", array('controller'=>'states','action' => 'old'));

    if(isset($StateFilter))
    {
        echo $this->Html->link(
    	    'All Active Connections',
    	    array('controller' => 'states', 'action' => 'index'),
    	    array('class' =>'btn btn-small btn-info')
	       );
    }
/*
    echo $this->TB->button_link(
	    'Old Sessions',
	    array('controller' => 'states', 'action' => 'old'),
	    array("style" => "info", "size" => "mini")
	);
*/
?>

