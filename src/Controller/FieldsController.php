<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fields Controller
 *
 * @property \App\Model\Table\FieldsTable $Fields
 */
class FieldsController extends AppController
{

    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'user'){
            
            if(in_array($this->request->action, [ 'add'])){
                if($user['owner'] == 1){
                    return true;
                }
            }
            
            if(in_array($this->request->action, ['view','edit','delete'])){
                $id = $this->request->params['pass'][0];
                $field = $this->Fields->get($id);   
                if ($field->user_id == $user['id']){
                    return true;
                }
            }
            
        }
        return parent::isAuthorized($user);
    }
    


    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $fields = $this->paginate($this->Fields);

        $this->set(compact('fields'));
        $this->set('_serialize', ['fields']);
    }

    /**
     * View method
     *
     * @param string|null $id Field id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $field = $this->Fields->get($id, [
            'contain' => ['Users', 'UsersGames']
        ]);

        $this->set('field', $field);
        $this->set('_serialize', ['field']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $field = $this->Fields->newEntity();
        if ($this->request->is('post')) {
            $field = $this->Fields->patchEntity($field, $this->request->data);
            $field['user_id'] = $this->Auth->user('id');
            $inicio = $field['start'];
            $fin = $field['finish'];
            if($inicio > $fin){
                $this->Flash->error(__('La hora de inicio debe de ser menor que la hora de cierre.'));
            }else if($inicio < 0 || $inicio > 23){
                $this->Flash->error(__('La hora de inicio debe de ser mayor a 0 o menor a 24.'));
            }else if($fin < 0 || $fin > 23){
                $this->Flash->error(__('La hora de cierre debe de ser mayor a 0 o menor a 24.'));
            }else{
                if ($this->Fields->save($field)) {
                    $this->Flash->success(__('La cancha ha sido creada.'));
    
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('La cancha no se pudo crear. Por favor, intente de nuevo.'));
            }
            
        }
        //$users = $this->Fields->Users->find('list', ['limit' => 200]);
        $this->set(compact('field')); //$this->set(compact('field', 'users'));
        $this->set('_serialize', ['field']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Field id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $field = $this->Fields->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $field = $this->Fields->patchEntity($field, $this->request->data);
            if ($this->Fields->save($field)) {
                $this->Flash->success(__('La cancha ha sido modificada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La cancha no ha sido modificada. Intentelo nuevamente.'));
        }
        $users = $this->Fields->Users->find('list', ['limit' => 200]);
        $this->set(compact('field', 'users'));
        $this->set('_serialize', ['field']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Field id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $field = $this->Fields->get($id);
        if ($this->Fields->delete($field)) {
            $this->Flash->success(__('La cancha se ha eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la cancha. Intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
