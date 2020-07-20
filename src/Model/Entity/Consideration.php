<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Consideration Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $seminar_id
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $updated_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Seminar $seminar
 */
class Consideration extends Entity
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
        'user_id' => true,
        'seminar_id' => true,
        'created_at' => true,
        'updated_at' => true,
        'user' => true,
        'seminar' => true,
    ];
}
