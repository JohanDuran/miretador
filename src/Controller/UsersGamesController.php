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
            return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
        }
        $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
        return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
        
        
        //Tenia fé de qe funcionara. jeje
        /* 
        
        $query = $this->UsersGames->find()
                        ->where(function ($exp, $q) use ($meet){
                        return $exp->eq('meet', $meet);
                        })
                        ->andwhere(function ($exp, $q) use ($field_id) {
                            return $exp->eq('field_id',$field_id);
                        });
                        
        $query = $query->toArray();
                        
        if(isset($query)){
            foreach($query as $partido){
                if($partido->state == 1){
                    $this->Flash->error(__('Ya existe un partido a esta hora. Por favor busque otra hora.'));
                }elseif ($partido->state == 0) {
                    $this->UsersGames->getConnection()->transactional(function () use ($partido) {
                        if(deleteReto($partido)){
                            if ($this->UsersGames->save($usersGame)) {
                                $this->Flash->success(__('Partido agregado con exito.'));
                    
                                return $this->redirect(['action' => 'index']);
                            }
                            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
                        }else{
                            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
                        }
                    });
                }
            }
        }else{
            $this->UsersGames->getConnection()->transactional(function () use ($partido) {
                if ($this->UsersGames->save($usersGame)) {
                    $this->Flash->success(__('Partido agregado con exito.'));
        
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));  
            });
        }*/
        
    }

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
        
        if($usersGame->user_id == $user_id){
            $this->Flash->error(__('Ocurrió un error, no puedes aceptar tu propio reto. Presiona alquilar para reservar la cancha completa.'));
            return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
        }else{
            if ($this->UsersGames->save($usersGame)) {
                $this->Flash->success(__('Reto confirmado.'));
    
                return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
            }
            $this->Flash->error(__('Ocurrió un error, intente nuevamente.'));
            return $this->redirect(['controller'=>'Fields', 'action' => 'visit_view', $field_id]);
        }
        
        
        
        
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
            //$users_games = $this->loadModel('UsersGames');
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
/*          $handle = fopen("prueba.txt",'w');
            fwrite($handle,json_encode($ultimosPartidos));
            fclose($handle);*/
            echo json_encode($ultimosPartidos);
            //$this->set(['games' => $ultimosPartidos]);        
        }else{
            $this->Flash->error(__('Ocurrió un error.'));
            return $this->redirect(['controller'=>'Pages', 'action' => 'display', 'home']);
        }
    }
}
