<h3>All Stations</h3>
<?php
if(count($devices)> 0)
{
?>
<table class="sortable table table-striped">
<thead>
  <tr>
    <th>No</th>
    <th>Name</th>
    <th>Serial</th>
    <th>Owner</th>
    <th>Comment</th>
    <th>Active Connections</th>
    <th>Last Disconnection</th>
    <th>Actions</th>
  </tr>
</thead>
<tbody>  
<?php $cnt=1; foreach ($devices as $device): ?> 
  <tr>
    <td><?php echo $cnt++;?></td>
    <td><?php echo $device['Device']['name']; ?></td>
    <td><?php echo $device['Device']['serial']; ?></td>
    <td><?php echo $device['Device']['owner']; ?></td>
    <td><?php echo $device['Device']['comment']; ?></td>
    <td><?php
    /* 
      foreach ($device['LiveState'] as $state):
        echo $state['ip'].":".$state['port']." - ".$state['ses_start']."<br/>";
      endforeach;
    */
        if(count($device['LiveState'])>0)
        {
            echo $this->Html->link(' '.count($device['LiveState']).' ', 
                    array('controller' => 'states', 'action' => 'index', 'serial', $device['Device']['serial']),
                    array('class'=>'btn btn-mini btn-success')); 
        }
    ?></td>
    <td><?php 
    /*
      foreach ($device['DeadState'] as $state):
        echo $state['ip'].":".$state['port']." - ".$state['ses_start']."<br/>";
      endforeach;
     */
        if(count($device['DeadState'])>0)
        {
            $DeadState = $device['DeadState'][0]; 
            echo $this->Html->link($DeadState['ses_end'], 
                    array('controller' => 'states', 'action' => 'old', 'serial', $device['Device']['serial']),
                    array('class'=>'btn btn-mini btn-inverse')); 
        }
    
    ?></td>
    <td>
    <?php 
      echo $this->Form->postLink('Delete',
              array('action' => 'delete', $device['Device']['id']),
              array('class'=>'btn btn-mini btn-danger'),
              array('confirm' => 'Are you sure?')
              );
      ?>
    <?php echo $this->Html->link('Edit', array('action' => 'edit', $device['Device']['id']),array('class'=>'btn btn-mini btn-warning'));?>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php
}
else
{
  echo '<div class="alert alert-warning">There is no device.</div>';
}
?>
<?php
    echo $this->Html->link('Add Device', array('controller' => 'devices', 'action' => 'add'),array('class'=>'btn btn-small btn-primary'));
?>
