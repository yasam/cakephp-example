<?php
class StatesController extends AppController {
    public $name = 'States';
    public $paginate = array(        
		'limit' => 20       
	    );
    
    public function index($key=null, $key_value=null) {
		$conditions = array('State.status !='=>'CLOSED');

		if($key != null && $key_value != null)
        {
			$conditions['State.'.$key] = $key_value;
            $this->set('StateFilter', $key);
	    }
		$order = array('State.serial');
		$order[] = 'State.ses_start DESC';
		
		
		$this->set('States', $this->State->find('all', array('conditions'=>$conditions, 'order'=>$order)));
    }

    public function old($key=null, $key_value=null) {
		$conditions = array('State.status' => 'CLOSED');
		if($key != null && $key_value != null)
        {
			$conditions['State.'.$key] = $key_value;
            $this->set('StateFilter', $key);
	    }
		
		$order = array('State.ses_end'=>'DESC');
		$order['State.serial'] = 'ASC';
        
		$this->paginate['conditions'] = $conditions;
        $this->paginate['order'] = $order;
        //print_r($this->paginate);
		$this->set('States', $this->paginate());
    }
    
    public function add() {
        if ($this->request->is('post')) {
            if ($this->State->save($this->request->data)) {
                $this->Session->setFlash('Your State has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function edit($id = null) {
        $this->State->id = $id;
        if ($this->request->is('get')) {
    	    $this->request->data = $this->State->read();
        } else {
            if ($this->State->save($this->request->data)) {
                $this->Session->setFlash('Your State has been updated.');
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function close($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->State->id = $id;
		$s = $this->State->read();
		
		$fp = fsockopen("127.0.0.1",1900,$errno,$errstr,$timeout=30); 
		if($fp) 
		{
			$params = array('IP'=>$s['State']['ip'], 'PORT'=>$s['State']['port']);
			$data = array('command'=>array('name'=>'CLOSE','params'=>$params));
			
			fputs($fp, json_encode($data));
			fclose($fp); 
			$msg = "Closing ".$s['State']['ip'].":".$s['State']['port'];
      $class = "alert alert-success";		
    }
		else
		{
			$msg = "Internal Error(".$errstr.$errno."), try again.";
      $class = "alert alert-error";
		}
		
		$this->Session->setFlash($msg, 'default', array('class'=>$class));
		$this->redirect($this->referer());
    }
}
