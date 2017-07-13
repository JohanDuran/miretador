<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Fields Controller
 *
 * @property \App\Model\Table\FieldsTable $Fields
 */
class FieldsController extends AppController
{

    public function isAuthorized($user){
        if(isset($user['role']) and $user['role'] === 'user'){
            
            if(in_array($this->request->action, [ 'visitView', 'autocompleteField', 'searchResult'])){
                    return true;
            }
            
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
    
    public function beforeFilter(\Cake\Event\Event $event){
        
        parent::beforeFilter($event);
        $this->Auth->allow(['visitView', 'autocompleteField', 'searchResult']);
        
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
        
        $owner = $this->Fields->Users->get($field->user_id, ['fields' => ['name']]);

        $this->set(['field' => $field, 'owner' => $owner]);
        $this->set('_serialize', ['field']);
    }
    
    
    
    public function visitView($id = null)
    {
        $field = $this->Fields->get($id, [
            'contain' => ['Users', 'UsersGames']
        ]);
        
        
        $favorite = $this->Fields->UsersFields->find('all', ['conditions' => ['UsersFields.field_id' => $id, 'UsersFields.user_id' => $this->Auth->user('id')]]);
        
        $owner = $this->Fields->Users->get($field->user_id, ['fields' => ['name']]);
        
        //Consulta para llenar la tabla.
        
        
        
        $date = new DateTime();
        $today = new DateTime();
        $date->sub(new DateInterval('P7D'));
        
        $begin = new DateTime( '2010-05-01' );
        $end = new DateTime( '2010-05-10' );
        
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        
        $hoy = new DateTime('NOW')
        $hoy = $hoy->format('d-m-Y');
        
        
        
        
        
        
        
        
        
        

        $this->set(['field' => $field, 'owner' => $owner, 'favorite' => $favorite->first()]);
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
    
    public function autocompleteField() {

        if ($this->request->is('ajax')) {
            //$this->autoLayout = false;
            $this->viewBuilder()->autoLayout();
            $this->autoRender = false;
            $name = $this->request->query['term'];
            $name=htmlspecialchars($name);
            $results = $this->Fields->find('all', [
                'conditions' => ['Fields.name LIKE' => '%'.$name.'%'], 'fields' => ['name', 'id']
            ]);
            foreach ($results as $result) {
                 $resultsArr[] =['label' => $result['name'], 'value' => $result['id']];
            }
            echo json_encode($resultsArr);
        }
    }
    
    
    
    public function searchResult(){
        if($this->request->is('post')){
            $parametros = $this->request->data;
            $id = $parametros['identifier'];
            $name = $parametros['byName'];
            $lat = $parametros['lat'];
            $lng = $parametros['lng']; 
            $location = $parametros['byLocation'];

            if($lat!=-1 && $lng != -1){
                if($id!=-1){
                    /*
                    Busque id, luego busque por nombre like -> ordenado por distancia.
                    */
                    $query = $this->Fields->find()
                                ->contain(['Users' => function(\Cake\ORM\Query $q) {
                                    return $q->where(['Users.id =' => 'Fields.user_id']); }, 'Users' => function(\Cake\ORM\Query $q) {
                                    return $q->where(['UsersFields.field_id' => 'Fields.id', 'UsersFields.user_id' => $this->Auth->user('id')]); }])
                                ->where(['Fields.id'=> $id]);
        
                    $query2 = $this->Fields->find('all');
                    //formula para calcular distancia entre dos puntos
                    $query2->select(['distance'=>"(6371 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS(latitude ) ) * COS( RADIANS(longitude ) - RADIANS( $lng ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS(latitude ) ) ))"])
                        ->where(['AND'=>['name LIKE' => '%'.$name.'%', 'id <> '=>$id]]) 
                        ->group('distance')
                        ->having(['distance <' => 20])//distancia en kilometros
                        ->select($this->Fields);
                    //print_r($query2->toArray());
                    $this->set(['byId' => $query->first(), 'byName' => $query2->toArray(), 'name' => $name]);
                }else if($name!=-1){
                    /*
                    Busque por nombre like -> ordenado por distancia.
                    */
                    $query = $this->Fields->find('all');
                    //formula para calcular distancia entre dos puntos
                    $query->select(['distance'=>"(6371 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS(latitude ) ) * COS( RADIANS(longitude ) - RADIANS( $lng ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS(latitude ) ) ))"])
                        ->where(['name LIKE' => '%'.$name.'%'])
                        ->group('distance')
                        ->having(['distance <' => 20])//distancia en kilometros                   
                        ->select($this->Fields);

                    $this->set(['byName' => $query->toArray(), 'name' => $name]);
                    
                }else{
                    /*
                    Todas las canchas -> ordenado por distancia.
                    */
                    $query = $this->Fields->find('all');
                    //formula para calcular distancia entre dos puntos
                    $query->select(['distance'=>"(6371 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS(latitude ) ) * COS( RADIANS(longitude ) - RADIANS( $lng ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS(latitude ) ) ))"])
                        ->group('distance')
                        ->having(['distance <' => 20])//distancia en kilometros                   
                        ->select($this->Fields);
                    $this->set(['byLocation' => $query->toArray(), 'name' => $name]);                    
                }
            }else{
                if($id!=-1){
                    /*
                    Busque id, luego busque por nombre like -> ordenado por Nombre.
                    */
                    $query = $this->Fields->find()
                                ->contain(['Users' => function(\Cake\ORM\Query $q) {
                                    return $q->where(['Users.id =' => 'Fields.user_id']); }, 'Users' => function(\Cake\ORM\Query $q) {
                                    return $q->where(['UsersFields.field_id' => 'Fields.id', 'UsersFields.user_id' => $this->Auth->user('id')]); }])
                                ->where(['Fields.id'=> $id]);
                    $query2 = $this->Fields->find()
                                ->contain(['Users' => function(\Cake\ORM\Query $q) {
                                    return $q->where(['Users.id' => 'Fields.user_id']); }])
                                ->where(['name LIKE' => '%'.$name.'%', 'id !='=> $id]);
                    $this->set(['byId' => $query->first(), 'byName' => $query2->toArray(), 'name' => $name]);
                }else if($name!=-1){
                    /*
                    Busque por nombre like -> ordenado por Nombre.
                    */
                    $query = $this->Fields->find()
                                ->contain(['Users' => function(\Cake\ORM\Query $q) {
                                    return $q->where(['Users.id' => 'Fields.user_id']); }])
                                ->where(['name LIKE' => '%'.$name.'%']);
                    $this->set(['byName' => $query->toArray(), 'name' => $name]);
                }
            }
        }
    }



/*    public function nearestPoints($lat,$lng,$name){
        
        $query = $this->Fields->find('all');
        //formula para calcular distancia entre dos puntos
        $query->select(['name','distance'=>"(6371 * ACOS( COS( RADIANS( $lat ) ) * COS( RADIANS(latitude ) ) * COS( RADIANS(longitude ) - RADIANS( $lng ) ) + SIN( RADIANS( $lat ) ) * SIN( RADIANS(latitude ) ) ))"])
        ->where(['name LIKE' => '%'.$name.'%'])
        ->group('distance')
        ->having(['distance <' => 20]);//distancia en kilometros
        return $query;
    }*/
}
