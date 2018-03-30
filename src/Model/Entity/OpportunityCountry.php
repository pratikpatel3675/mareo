<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpportunityCountry Entity.
 *
 * @property int $id
 * @property int $opportunity_id
 * @property \App\Model\Entity\Opportunity $opportunity
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $provider_office_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\ProviderCountry $provider_country
 */
class OpportunityCountry extends Entity
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
