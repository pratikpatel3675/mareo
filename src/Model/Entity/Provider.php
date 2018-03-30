<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Provider Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $provider_type_id
 * @property \App\Model\Entity\ProviderType $provider_type
 * @property string $website
 * @property string $email
 * @property string $description_en
 * @property string $description_ara
 * @property string $logo_filename
 * @property string $hq_addr_line1
 * @property string $hq_addr_line2
 * @property string $hq_addr_line3
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property string $hq_phone
 * @property string $hq_fax
 * @property string $city
 * @property int $postcode
 * @property int $is_active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\Opportunity[] $opportunities
 * @property \App\Model\Entity\ProviderCountry[] $provider_countries
 * @property \App\Model\Entity\ProviderUser[] $provider_users
 */
class Provider extends Entity
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
