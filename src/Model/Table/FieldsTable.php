<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fields Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $UsersGames
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \App\Model\Entity\Field get($primaryKey, $options = [])
 * @method \App\Model\Entity\Field newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Field[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Field|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Field patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Field[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Field findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FieldsTable extends Table
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

        $this->table('fields');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('UsersGames', [
            'foreignKey' => 'field_id'
        ]);
        $this->belongsToMany('Users', [
            'foreignKey' => 'field_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'users_fields'
        ]);
        
        $this->addBehavior('Proffer.Proffer', [
        	'photo' => [	// The name of your upload field
        		'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
        		'dir' => 'photo_dir',	// The name of the field to store the folder
        		'thumbnailSizes' => [ // Declare your thumbnails
        			'landscape' => [		// Define a second thumbnail
        				'w' => 1280,
        				'h' => 375,
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('description');

        $validator
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude');

        $validator
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->requirePresence('contact', 'create')
            ->notEmpty('contact');

        $validator
            ->integer('start')
            ->requirePresence('start', 'create')
            ->notEmpty('start');

        $validator
            ->integer('finish')
            ->requirePresence('finish', 'create')
            ->notEmpty('finish');

        $validator
            ->provider('proffer', 'Proffer\Model\Validation\ProfferRules')
            
            ->add('photo', 'proffer', [
                'rule' => ['dimensions', [
                    'min' => ['w' => 1280, 'h' => 375],
                    'max' => ['w' => 2360, 'h' => 1280]
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
