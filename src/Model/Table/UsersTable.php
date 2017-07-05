<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Fields
 * @property \Cake\ORM\Association\HasMany $UsersGames
 * @property \Cake\ORM\Association\BelongsToMany $Fields
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fields', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UsersGames', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsToMany('Fields', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'field_id',
            'joinTable' => 'users_fields'
        ]);
        
        
        
        $this->addBehavior('Proffer.Proffer', [
        	'photo' => [	// The name of your upload field
        		'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
        		'dir' => 'photo_dir',	// The name of the field to store the folder
        		'thumbnailSizes' => [ // Declare your thumbnails
        			'square' => [		// Define a second thumbnail
        				'w' => 300,
        				'h' => 300,
        				'crop' => true,
        				'jpeg_quality'	=> 100
        			],
        		],
        		'thumbnailMethod' => 'gd'	// Options are Imagick or Gd
        	]
        ]);
        
        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->notEmpty('id', 'create');

        $validator
            ->add('email','valid',['rule'=> 'email' , 'message' => 'Ingrese un correo válido.'])
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'Rellene este campo.');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password' , 'Rellene este campo.', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name' , 'Rellene este campo.');

        $validator
            ->allowEmpty('phone');

        $validator
            ->boolean('owner')
            ->allowEmpty('owner');

        $validator
            ->allowEmpty('description');

        $validator
            ->provider('proffer', 'Proffer\Model\Validation\ProfferRules')
            
            ->add('photo', 'proffer', [
                'rule' => ['dimensions', [
                    'min' => ['w' => 200, 'h' => 300],
                    'max' => ['w' => 800, 'h' => 1200]
                    ]],
                    'message' => 'La imagen no tiene las dimensiones correctas.',
                    'provider' => 'proffer'
                ])
                
            ->add('photo', 'extension', [
                'rule' => ['extension', [
                   'jpeg' , 'png' , 'jpg'
                    ]],
                    'message' => 'La imagen no tiene la extensión correctas.',
                ])
                
            ->add('photo', 'fileSize', [
                'rule' => ['fileSize', '<=', "1MB"],
                    'message' => 'La imagen no debe exceder 1MB.',
                ])
            ->add('photo', 'mimeType', [
                'rule' => ['mimeType', ['image/jpeg', 'image/png']],
                    'message' => 'La imagen no es del formato correcto.',
                ])
            ->allowEmpty('photo');
                

        $validator
            ->allowEmpty('photo_dir');
            
        
        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');
            
        $validator
            ->add('active', 'valid', ['rule' => 'boolean'])
            ->requirePresence('active', 'create')
            ->notEmpty('active');
        

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'Ya existe un usuario con este correo.'));

        return $rules;
    }
    
    
    public function findAuth(\Cake\ORM\Query $query, array $options ){
        $query
            ->select(['id', 'name', 'email', 'password', 'role', 'description', 'phone', 'photo', 'photo_dir', 'owner'])
            ->where(['Users.active' => 1]);
            
        return $query;
    }
    
    public function recoverPassword($id)
    {
        $user = $this->get($id);
        return $user->password;
    }
    public function beforeDelete($event, $entity, $options)
    {
        if ($entity->role == 'admin')
        {
            return false;
        }
        return true;
    }
    
}
