<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersFields Controller
 *
 * @property \App\Model\Table\UsersFieldsTable $UsersFields
 */
class UsersFieldsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Fields']
        ];
        $usersFields = $this->paginate($this->UsersFields);

        $this->set(compact('usersFields'));
        $this->set('_serialize', ['usersFields']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Field id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersField = $this->UsersFields->get($id, [
            'contain' => ['Users', 'Fields']
        ]);

        $this->set('usersField', $usersField);
        $this->set('_serialize', ['usersField']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersField = $this->UsersFields->newEntity();
        if ($this->request->is('post')) {
            $usersField = $this->UsersFields->patchEntity($usersField, $this->request->data);
            if ($this->UsersFields->save($usersField)) {
                $this->Flash->success(__('The users field has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users field could not be saved. Please, try again.'));
        }
        $users = $this->UsersFields->Users->find('list', ['limit' => 200]);
        $fields = $this->UsersFields->Fields->find('list', ['limit' => 200]);
        $this->set(compact('usersField', 'users', 'fields'));
        $this->set('_serialize', ['usersField']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Field id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersField = $this->UsersFields->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersField = $this->UsersFields->patchEntity($usersField, $this->request->data);
            if ($this->UsersFields->save($usersField)) {
                $this->Flash->success(__('The users field has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users field could not be saved. Please, try again.'));
        }
        $users = $this->UsersFields->Users->find('list', ['limit' => 200]);
        $fields = $this->UsersFields->Fields->find('list', ['limit' => 200]);
        $this->set(compact('usersField', 'users', 'fields'));
        $this->set('_serialize', ['usersField']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Field id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersField = $this->UsersFields->get($id);
        if ($this->UsersFields->delete($usersField)) {
            $this->Flash->success(__('The users field has been deleted.'));
        } else {
            $this->Flash->error(__('The users field could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
