<?php
// app/Controller/DevicesController.php
class DevicesController extends AppController {

    public function index() {
        $options['joins'] = array(
            array('table' => 'states',
            'alias' => 'State',
            'type' => 'LEFT',
            'conditions' => array(
                'State.serial = Device.serial',
              )
            )
        );
        
        $options['conditions'] = array(
          'State.status' => 'CLOSED'
        );
        //$this->set('devices', $this->Device->find('all', $options));
        $this->Device->primaryKey = "serial";
        $this->set('devices', $this->Device->find('all'));
    }

    public function add($key_idx=null) {
        if ($this->request->is('post')) {
            $this->Device->create();
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        }
        else
        {
            if($key_idx == null)
                return;

            $this->loadModel('State');
            $this->State->id = $key_idx; 
            $conn = $this->State->read();
            if($conn == null)
            {
                $msg = "Invalid index.";
                goto error;
            }
            
            $rec = $this->Device->find('first', array('conditions'=>array('Device.serial'=>$conn['State']['serial'])));
            if($rec != null)
            {
                $msg = 'Device already exists.';
                goto error;
            }

            $data = array('Device'=>array());
            $data['Device']['name'] = $conn['State']['name'];
            $data['Device']['serial'] = $conn['State']['serial']; 
            $this->request->data = $data;
            
            return;
            error:
                $this->Session->setFlash($msg, 'default',array('class'=>'alert alert-error'));
                $this->redirect($this->referer());                            
                
        }
    }

    public function edit($id = null) {
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Device->save($this->request->data)) {
                $this->Session->setFlash(__('The device has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The device could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Device->read(null, $id);
            unset($this->request->data['Device']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Device->id = $id;
        if (!$this->Device->exists()) {
            throw new NotFoundException(__('Invalid device'));
        }
        if ($this->Device->delete()) {
            $this->Session->setFlash(__('Device deleted'));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Device was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}
