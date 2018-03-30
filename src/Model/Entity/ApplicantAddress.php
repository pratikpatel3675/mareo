<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantAddress Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $addr_line1
 * @property string $addr_line2
 * @property string $addr_line3
 * @property string $city
 * @property string $state
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property string $postcode
 * @property string $phone_landline
 * @property string $phone_mobile
 * @property string $email
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ApplicantAddress extends Entity
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
