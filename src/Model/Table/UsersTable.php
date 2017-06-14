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
        			'portrait' => [		// Define a second thumbnail
        				'w' => 100,
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone');

        $validator
            ->boolean('owner')
            ->allowEmpty('owner');

        $validator
            ->allowEmpty('description');

        $validator
            ->provider('proffer', 'Proffer\Model\Validation\ProfferRules')
            
            ->add('photo', 'proffer', [
                'rule' => ['dimensions', [
                    'min' => ['w' => 100, 'h' => 300],
                    'max' => ['w' => 640, 'h' => 960]
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
                    'message' => 'La imagen no debe exceder 1MB.',
                ])
            ->allowEmpty('photo');
                

        $validator
            ->allowEmpty('photo_dir');

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
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
