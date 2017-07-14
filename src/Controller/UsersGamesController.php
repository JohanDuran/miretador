<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersGames Controller
 *
 * @property \App\Model\Table\UsersGamesTable $UsersGames
 */
class UsersGamesController extends AppController
{

    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'user'){
            
            if(in_array($this->request->action, [ 'add', 'edit'])){
                    return true;
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
        $this->paginate = [
            'contain' => ['Users', 'Fields']
        ];
        $usersGames = $this->paginate($this->UsersGames);

        $this->set(compact('usersGames'));
        $this->set('_serialize', ['usersGames']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Game id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersGame = $this->UsersGames->get($id, [
            'contain' => ['Users', 'Fields']
        ]);

        $this->set('usersGame', $usersGame);
        $this->set('_serialize', ['usersGame']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($user_id, $field_id, $meet, $state)
    {
        $this->request->allowMethod(['post']);
        $usersGame = $this->UsersGames->newEntity();
        $meet = $meet.":00:00";
        $meet = strtotime($meet);
        $usersGame->user_id = $user_id;
        $usersGame->field_id = $field_id;
        $usersGame->state = $state;
        $usersGame->meet = $meet;
        if ($this->UsersGames->save($usersGame)) {
            $this->Flash->success(__('Partido agregado con exito.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
        
        /*$users = $this->UsersGames->Users->find('list', ['limit' => 200]);
        $fields = $this->UsersGames->Fields->find('list', ['limit' => 200]);
        $this->set(compact('usersGame', 'users', 'fields'));
        $this->set('_serialize', ['usersGame']);*/
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Game id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $user_id)
    {
        $usersGame = $this->UsersGames->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersGame = $this->UsersGames->patchEntity($usersGame, $this->request->data);
            if ($this->UsersGames->save($usersGame)) {
                $this->Flash->success(__('The users game has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users game could not be saved. Please, try again.'));
        }
        $users = $this->UsersGames->Users->find('list', ['limit' => 200]);
        $fields = $this->UsersGames->Fields->find('list', ['limit' => 200]);
        $this->set(compact('usersGame', 'users', 'fields'));
        $this->set('_serialize', ['usersGame']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Game id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersGame = $this->UsersGames->get($id);
        if ($this->UsersGames->delete($usersGame)) {
            $this->Flash->success(__('The users game has been deleted.'));
        } else {
            $this->Flash->error(__('The users game could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
