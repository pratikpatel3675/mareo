<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProviderOffice Entity.
 *
 * @property int $id
 * @property int $provider_id
 * @property \App\Model\Entity\Provider $provider
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property string $name
 * @property string $addr_line1
 * @property string $addr_line2
 * @property string $addr_line3
 * @property string $city
 * @property string $postcode
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property int $is_active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\OpportunityCountry[] $opportunity_countries
 * @property \App\Model\Entity\ProviderOfficeUser[] $provider_office_users
 */
class ProviderOffice extends Entity
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
