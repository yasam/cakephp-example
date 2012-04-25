<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('Helper', 'View');

/**
 * Description of tools
 *
 * @author yasam
 */
class ToolHelper extends AppHelper {
	var $helpers = array('Html');
	public function dump_tasks($key, $key_idx, $tasks)
	{
		$f = "";
		$s = "";
		$pre = "";
		foreach ($tasks as $task):
			$s .= $pre . $task['name'];
			$pre = ", ";
			if($f == "")
				$f = $task['name'];
		endforeach;
		
		$title = $s;
		
		if(count($tasks) > 1)
			$s = $tasks[0]['name'];
		
		
		$s .=" (".count($tasks).")"; 
		echo $this->Html->link($s, array('controller'=>'tasks','action' => 'index', $key, $key_idx), array('title'=>$title));
	}
	public function put_name_link($name, $key, $idx)
	{
		echo $this->Html->link($name, array('controller'=>'logs','action' => 'filter', $key, $idx));
	}
	public function dump_tasks_of_recipient($recipient, $alltasks)
	{
		$s = "";
		$pre = "";
		foreach ($recipient['TaskRecipient'] as $tr):
			$s .= $pre.$alltasks[$tr['task_id']];
			$pre = ", ";
		endforeach;
				
		$title = $s;

		if(count($recipient['TaskRecipient']) > 1)
				$s = $alltasks[$recipient['TaskRecipient'][0]['task_id']];
		
		$s .= "(".count($recipient['TaskRecipient']).")";
		
		echo $this->Html->link($s, array('controller'=>'task_recipients','action' => 'tasks', $recipient['Recipient']["id"]), array('title'=>$title));
		
		
	}
	public function dump_recipients($task, $allrecipients)
	{
		$s = "";
		$pre = "";
		foreach ($task['TaskRecipient'] as $tr):
			$s .= $pre.$allrecipients[$tr['recipient_id']];
			$pre = ", ";
				
		endforeach;
		
		$title = $s;
		
		if(count($task['TaskRecipient']) > 1)
			$s = $allrecipients[$task['TaskRecipient'][0]['recipient_id']];
		
		$s .= " (".count($task['TaskRecipient']).")";
		
		echo $this->Html->link($s, array('controller'=>'task_recipients','action' => 'recipients', $task['Task']["id"]), array('title'=>$title));
		
		
	}
	public function dump_results($tasks)
	{
		$d = 0;
		$f = 0;
		$s = 0;
		$c = 0;
		$pre = "";
		foreach ($tasks as $task):
			if($task["enabled"] == "0")
			{
				$d++;
				continue;
			}
			if($task["state"] == "RUNNING")
			{
				$c++;
				continue;
			}

			if($task["status"] == "OK")
				$s++;
			else
				$f++;
		endforeach;
		
		//echo " ".$c.",".$s.",".$f;
		
		if($c != 0)
			echo $this->Html->image('blue.png', array('alt' => $c));
		if($s != 0)
			echo $this->Html->image('green.png', array('alt' => $s));
		if($f != 0)
			echo $this->Html->image('red.png', array('alt' => $f));
		if($d != 0)
			echo $this->Html->image('black.png', array('alt' => $d));

	}
	public function get_stats($tasks)
	{
		$d = 0;
		$f = 0;
		$s = 0;
		$c = 0;
		foreach ($tasks as $task):
			if($task["interval"] == "0")
				continue;
			if($task["enabled"] == "0")
			{
				$d++;
				continue;
			}
			if($task["state"] == "RUNNING")
			{
				$c++;
				continue;
			}

			if($task["status"] == "OK")
				$s++;
			else
				$f++;
		endforeach;
		
		
		if($f > 0)
		{
			if($s == 0)
				$cl = "black";
			else
				$cl = "red";
		}
		else
		{
			if($s > 0)
				$cl = "green";
			else if($c > 0)
				$cl = "blue";
			else
				$cl = "grey";
				
		}
		return array($cl,$s,$f,$c,$d);
	}
	public function dump_dash($arr, $name, $view_name = null)
	{
		if($view_name == null)
			$view_name = $name;
		
		echo '<div class="dash">';
		echo $this->Html->tag('h1',$view_name.'s', array("style"=>"float:left;"));
		echo '<span>S:F:R:D &nbsp;&nbsp;</span><br/>';
		echo '<ul>';
		foreach ($arr as $a): 
			list ($cl,$s,$f,$c,$d)= $this->get_stats($a['Task']);
			echo '<li class="'.$cl.'">';
			echo $this->Html->link($a[$name]['name'], array('controller'=>'logs','action' => 'filter', strtolower($name)."_id", $a[$name]['id']));
			//echo $a[$name]['name'];
			//$link = str_replace("\r","",$link);
			//$link = str_replace("\n","",$link);
			$lname = $s.':'.$f.':'.$c.':'.$d;
			echo '<span>'.$this->Html->link($lname, array('controller'=>'tasks','action' => 'index', strtolower($name)."_id", $a[$name]['id'])).'</span>';
			echo '</li>';
		endforeach; 
		echo '</ul>';
		echo "</div>";
	}
	
	public function isVisible($user, $msg = null)
	{
		if($user['role'] == 'admin')
		{
			if($msg != null)
				echo $msg;
			return true;
		}
		return false;
	}
}

?>
