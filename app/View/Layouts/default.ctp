<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeDescription = "Live Station";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('web');
		echo $this->Html->css('bootstrap');
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('cakebootstrap');

		echo $this->Html->script("standardista-table-sorting/common");
		echo $this->Html->script("standardista-table-sorting/css");
		echo $this->Html->script("standardista-table-sorting/standardista-table-sorting");

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="containerx">
		<div id="header" class="navbar">
      <div class="navbar-inner">
        <a class="brand" href="http://www.livestation.com" target="_blank">Live Station</a>
        <div class="container">
			<?php 
        //echo $this->Html->link($cakeDescription, 'http://www.livestation.com'); 
      ?>
      <?php
      $navlist = array('Stations' => array('controller'=>'devices', 'action'=>'index'),
                    'Connections' => array('controller'=>'states', 'action'=>'index'),
                    'Reports' => array('controller'=>'states', 'action'=>'old')
                );
  
      ?>
      <ul class="nav nav-pills">
        <?php
          $controller = $this->params['controller'];
          $action = $this->params['action'];
    
          $keys = array_keys($navlist);
          foreach ($keys as $key):
            $class = "";
            if($navlist[$key]['controller'] == $controller && $navlist[$key]['action'] == $action)
                $class = "active";
            
            echo '<li class="'.$class.'">';
            echo $this->Html->link($key,
          	                 array('controller' =>$navlist[$key]['controller'] , 'action'=>$navlist[$key]['action']));
            echo "</li>";
          endforeach;
        ?>
      </ul>
        </div>
      </div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
