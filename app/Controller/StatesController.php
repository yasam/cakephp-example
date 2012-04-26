<?php
class StatesController extends AppController {
    public $name = 'States';
    
    public function index() {
		$this->set('States', $this->State->find('all', array('order' => array('State.ses_start ASC'))));
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
    
    public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->State->delete($id)) {
    		    $this->Session->setFlash('Deleted.');
    		    $this->redirect($this->referer());
		}
		else{
		    $this->Session->setFlash('Could not delete.');
		    $this->render('../Layouts/err');
		}
		
    }
}
