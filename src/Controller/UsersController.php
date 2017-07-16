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
            if(in_array($this->request->action, [ 'logout'])){
                return true;
            }
            
            if(in_array($this->request->action, ['view','edit', 'delete','owner'])){
                $id = $this->request->params['pass'][0];
                $userb = $this->Users->get($id);
                if ($userb->id == $user['id']){
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
        $user = $this->Users->get($id, [
            'contain' => ['Fields', 'UsersGames']
        ]);
        $fields = $this->loadModel('Fields');
        $myFields = $this->Users->Fields->find('all', ['conditions'=>['Fields.user_id'=>$id], 'fields'=>['Fields.id','Fields.user_id','Fields.name']]);
        $users_fileds = $this->loadModel('UsersFields');
        //$favorites = $this->Users->UsersFields->find('all', ['conditions'=>['UsersFields.user_id'=>$id], 'fields'=>['UsersFields.field_id']])->toArray();
        //$favoritesFields = $this->Users->Fields->find('all', ['conditions'=>['Fields.id'=>array_values($favorites)], 'fields'=>['Fields.id','Fields.name']]);
        //$favoritesFields = $this->Users->Fields->find('favoriteFields',['user' => $user]);
        
        
        $query = $fields->find()->contain('UsersFields', function ($q) {
        return $q
            ->select(['field_id'])
            ->where(['UsersFields.user_id' => $id]);
        } );
        
        
        $today = new \DateTime('NOW');
        
        $today->setTimezone(new \DateTimeZone('America/Costa_Rica'));
        //$today = $today->sub(new \DateInterval('PT6H'));
        
        

        $users_games = $this->loadModel('UsersGames');
        $confirmados = $users_games->find()->where(function ($exp) use ($id, $today) {
                            $orConditions = $exp->or_(['user_id' => $id])
                                ->eq('challenged', $id);
                            return $exp
                                ->add($orConditions)
                                ->gt('meet', $today)
                                ->eq('state', 1);
                        })
                        ->limit(5)
                        ->order(['meet' => 'ASC']);
                        
                        
                        
        
        
        
        
        
        
        
                    /*->where(function ($exp) use ($id) {
                        return $exp->or_([
                            'UsersGames.user_id' => $id,
                            'UsersGames.challenged' => $id
                        ]);
                    })
                    ->andwhere(function ($exp, $q) use ($today) {
                        return $exp->gt('meet',$today);
                    })
                    ->andwhere(function ($exp, $q) {
                        return $exp->eq('state',1);
                    })
                    ->limit(5)
                    ->order(['meet' => 'ASC']);*/
                    
        $confirmados = $confirmados->toArray();
        
        /*
        ->select(['field_id'])
            ->where(['UsersFields.user_id' => $id])
            ->andwhere(['meet >' => $today])
            ->andwhere(['state' => 1])
            ->limit(5)
            ->order(['meet' => 'ASC']);
        
        */
        
        foreach($confirmados as $game){
            $cancha = $this->Users->Fields->get($game->field_id, ['fields' => ['name']]);
            $game->field_name = $cancha;
            if(isset($game->challenged)){
                if($game->challenged == $id){
                    $retador = $this->Users->get($game->user_id, ['fields' => ['name']]);
                }else{
                    $retador = $this->Users->get($game->challenged, ['fields' => ['name']]);
                }
                
                $game->challenger_name = $retador;
            }
            
            
        }
        //print_r($confirmados);
        
        
        $this->set(['user'=> $user, 'fields' => $myFields->toArray(), 'favorite_fields' => $query->toArray(), 'games' => $confirmados]);
        
        
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
                $this->Flash->success(__('El usuario ha sido creado con exito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no se pudo crear. Intentelo nuevamente.'));
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
                $data = $user->toArray();
                unset($data['password']);
                unset($data['modified']);
                unset($data['created']);
                unset($data['active']);
                $this->Auth->setUser($data);
                $this->Flash->success('El usuario ha sido modificado');
                return $this->redirect(['action' => 'view', $this->Auth->user('id')]);
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
            return $this->redirect(['controller' => 'Users', 'action' => 'view' , $this->Auth->user('id') ]);
        }
        
    }
    
    public function home(){
        
        $this->render();
        
    }
    
    public function logout(){
        return $this->redirect($this->Auth->logout());
        
    }
    
    public function owner($id = null){
        
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            if( $user["owner"] == true){
                return $this->redirect(['controller'=>'Fields','action' => 'add']); //Envielo a agregar cancha
            }else{
                $user["owner"] = true; 
                if ($this->Users->save($user))
                {
                    $this->Flash->success('Muchas gracias por hacerte dueño!');
                    $data = $user->toArray();
                    //reloadAuth($data);//recarga la sesión 
                    unset($data['password']);
                    unset($data['modified']);
                    unset($data['created']);
                    unset($data['active']);
                    $this->Auth->setUser($data);
                    return $this->redirect(['controller'=>'Fields','action' => 'add']); //Envielo a agregar cancha
                }
                else
                {
                    $this->Flash->error('A ocurrido un error. Por favor, intente nuevamente.');
            }
            }
            
        }
    }
    
    
    public function reloadAuth($userData){
        unset($userData['password']);
        unset($userData['modified']);
        unset($userData['created']);
        unset($userData['active']);
        $this->Auth->setUser($userData);
    }
    
}


