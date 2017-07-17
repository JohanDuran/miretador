<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;

/**
 * UsersGames Controller
 *
 * @property \App\Model\Table\UsersGamesTable $UsersGames
 */
class UsersGamesController extends AppController
{

    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'user'){
            
            if(in_array($this->request->action, [ 'add', 'edit','viewAjax'])){
                    return true;
            }  
        }
        return parent::isAuthorized($user);
    }

    public function beforeFilter(\Cake\Event\Event $event){
        
        parent::beforeFilter($event);
        $this->Auth->allow(['add','viewAjax']);
        
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
        //echo $this->referer();
        $this->request->allowMethod(['post','get']);
        $usersGame = $this->UsersGames->newEntity();
        $meet = $meet.":00:00";
        $meet = strtotime($meet);
        $usersGame->user_id = $user_id;
        $usersGame->field_id = $field_id;
        $usersGame->state = $state;
        $usersGame->meet = $meet;
    
        $query = $this->UsersGames->find()
                        ->where(function ($exp, $q) use ($field_id) {
                            return $exp->eq('field_id',$field_id);
                        })
                        ->andwhere(function ($exp, $q) use ($meet){
                        return $exp->eq('meet', $meet);
                        });
                        
        $partido = $query->first();
        
        $usersGamesTable = TableRegistry::get('UsersGames');
        $usersTable = TableRegistry::get('Users');
        $fieldsTable = TableRegistry::get('Fields');
                        
        if(isset($partido)){
            if($partido->state == 1){
                $this->Flash->error(__('Ya existe un partido a esta hora. Por favor busque otra hora.'));
                return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
            }elseif ($partido->state == 0) {
                $usersGamesTable->connection()->transactional(function () use ($partido, $usersGame, $usersGamesTable, $field_id, $state) {
                    if($state == 1){
                        if($usersGamesTable->delete($partido)){
                            if ($usersGamesTable->save($usersGame)) {
                                $this->Flash->success(__('Partido agregado con exito.'));
                                return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                            }
                            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
                            return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                        }else{
                            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
                            return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                        }
                    }else{
                        $this->Flash->error(__('No puedes crear otro reto a esta hora.'));
                        return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                    }
                    
                });
            }
        }else{
            $usersGamesTable->connection()->transactional(function() use ($usersGamesTable, $usersTable, $fieldsTable, $usersGame, $field_id, $user_id){
                if ($usersGamesTable->save($usersGame)) {
                    $this->Flash->success(__('Partido agregado con éxito.'));
                   /* if($usersGame->state == 1){
                        $userInfo = $usersTable->get($user_id);
                        $cancha = $fieldsTable->get($field_id);
                        $email = new Email();
                        $email->to($userInfo->email);
                        $email->template('confirmation');
                        $email->viewVars(['user' => ['username' => $userInfo->name, 'fecha' => $usersGame->meet,  'fieldname' => $cancha->name]]);
                        $email->send();
                    }*/
                    
                    
                    
                    return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                    
                    
                }
                $this->Flash->error(__('Ocurrió un error, intente nuevamente.')); 
                return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
            });
        }
    }
    
    
    /*
    $email = new Email();
    $email->to('john@doe.com');
    $email->template('welcome');
    $email->viewVars(['user' => ['username' => 'johndoe']]);
    $email->send();
    */
    
    

    /**
     * Edit method
     *
     * @param string|null $id Users Game id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null, $user_id, $meet)
    {
        
        $this->request->allowMethod(['post']);
        
        $usersGame = $this->UsersGames->get($id);
        $usersGame->challenged = $user_id;
        $usersGame->state = 1;
        $usersGame->meet = strtotime($meet);
        $field_id = $usersGame->field_id;
        
        $query = $this->UsersGames->find()
                        ->where(function ($exp, $q) use ($field_id) {
                            return $exp->eq('field_id',$field_id);
                        })
                        ->andwhere(function ($exp, $q) use ($meet){
                        return $exp->eq('meet', strtotime($meet));
                        });
                        
        $partido = $query->first();
        
        $usersGamesTable = TableRegistry::get('UsersGames');
        
        if(isset($partido)){
            if($partido->state == 1){
                $this->Flash->error(__('El partido ya ha sido confirmado. Por favor busque otra hora.'));
                return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
            }elseif ($partido->state == 0) {
                if($usersGame->user_id == $user_id){
                    $this->Flash->error(__('Ocurrió un error, no puedes aceptar tu propio reto. Presiona alquilar para reservar la cancha completa.'));
                    return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
                }else{
                    $usersGamesTable->connection()->transactional(function () use ($usersGame, $usersGamesTable, $field_id) {
                        if ($usersGamesTable->save($usersGame)) {
                            $this->Flash->success(__('Partido agregado con exito.'));
                            return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                        }
                        $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
                        return $this->redirect(['controller' => 'Fields', 'action' => 'visit_view', $field_id]);
                    });
                }
            }
        }
        
        
        
        
        /*if($usersGame->user_id == $user_id){
            $this->Flash->error(__('Ocurrió un error, no puedes aceptar tu propio reto. Presiona alquilar para reservar la cancha completa.'));
            return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
        }else{
            if ($this->UsersGames->save($usersGame)) {
                $this->Flash->success(__('Reto confirmado.'));
    
                return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
            }
            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
            return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
        } */
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
            $this->Flash->success(__('Partido eliminado con exito.'));
        } else {
            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
        }

        return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
    }
    
    
    public function deleteReto($userGame){
        if ($this->UsersGames->delete($usersGame)) {
            return true;
        } else {
            return false;
        }
        
    }
    
    public function viewAjax()
    {
        if ($this->request->is('ajax')) {
            $this->viewBuilder()->autoLayout();
            $this->autoRender = false;
            $today = new \DateTime('NOW');
            $today->setTimezone(new \DateTimeZone('America/Costa_Rica'));
            
            $ultimosPartidos = $this->UsersGames->find()
                            ->where(function ($exp, $q) use ($today){
                                return $exp->gt('meet', $today);
                            })
                            ->limit(3)
                            ->order(['id' => 'DESC']);
    
            $ultimosPartidos = $ultimosPartidos->toArray();
            
            foreach($ultimosPartidos as $game){
                $cancha = $this->UsersGames->Fields->get($game->field_id, ['fields' => ['name']]);
                $game->field_name = $cancha;
                
                $game->meet = $game->meet->format('d-m-Y / H:i');
                
                //nombre del jugador retador
                if(isset($game->challenged)){
                    $retador = $this->UsersGames->Users->get($game->challenged, ['fields' => ['name']]);
                    $game->challenger_name = $retador;
                }
                //nombre del jugador retado
                $retado = $this->UsersGames->Users->get($game->user_id, ['fields' => ['name']]);
                $game->challenged_name = $retado;
            }

            echo json_encode($ultimosPartidos);
        }else{
            $this->Flash->error(__('Ocurrió un error.'));
            return $this->redirect(['controller'=>'Pages', 'action' => 'display', 'home']);
        }
    }
}
