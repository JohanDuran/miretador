<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'user'){
            if(in_array($this->request->action, ['home',  'logout'])){
                return true;
            }
            
            if(in_array($this->request->action, ['view','edit', 'delete'])){
                $id = $this->request->params['pass'][0];
                $user = $this->Users->get($id);
                if ($user->id == $user['id']){
                    return true;
                }
            }
            
        }
        return parent::isAuthorized($user);
    }
    
    public function beforeFilter(\Cake\Event\Event $event){
        
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
        
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id);
        $this->set('user', $user);
        
        /*$user = $this->Users->get($id, [
            'contain' => ['Fields', 'UsersGames']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);*/
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            
            $user->role = 'user'; //Role por defecto de los usuarios va a ser user.
            $user->active = 1; //Cambiar cuando tengamos el correo de confirmación.
            $user->owner = 0;  // Los usuarios por defecto no son dueños de cancha.
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $fields = $this->Users->Fields->find('list', ['limit' => 200]);
        $this->set(compact('user', 'fields'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user))
            {
                $this->Flash->success('El usuario ha sido modificado');
                return $this->redirect(['action' => 'index']);
            }
            else
            {
                $this->Flash->error('El usuario no pudo ser modificado. Por favor, intente nuevamente.');
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user))
        {
            $this->Flash->success('El usuario ha sido eliminado.');
        }
        else
        {
            $this->Flash->error('El usuario no pudo ser eliminado. Por favor, intente nuevamente.');
        }
        return $this->redirect(['action' => 'index']);
    }
    
    
    public function login(){
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            else{
                $this->Flash->error('Datos invalidos, por favor intente nuevamente.', ['key' => 'auth']);
            }
        }
        
        if ($this->Auth->user())
        {
            return $this->redirect(['controller' => 'Users', 'action' => 'home']);
        }
        
    }
    
    public function home(){
        
        $this->render();
        
    }
    
    public function logout(){
        return $this->redirect($this->Auth->logout());
        
    }
    
    
    
    
    
}
