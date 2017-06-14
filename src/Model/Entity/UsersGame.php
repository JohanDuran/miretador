<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UsersGame Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $field_id
 * @property \Cake\I18n\Time $meet
 * @property int $challenged
 * @property bool $state
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Field $field
 */
class UsersGame extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
