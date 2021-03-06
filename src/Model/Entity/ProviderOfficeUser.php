<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProviderOfficeUser Entity.
 *
 * @property int $id
 * @property int $provider_office_id
 * @property \App\Model\Entity\ProviderOffice $provider_office
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $is_active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ProviderOfficeUser extends Entity
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
        'id' => false,
    ];
}
