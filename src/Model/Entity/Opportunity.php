<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Opportunity Entity.
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ara
 * @property string $description_en
 * @property string $description_ara
 * @property int $opportunity_duration_id
 * @property \App\Model\Entity\OpportunityDuration $opportunity_duration
 * @property int $education_desired_type_id
 * @property \App\Model\Entity\EducationDesiredType $education_desired_type
 * @property int $donation_campaign_provider_id
 * @property \App\Model\Entity\DonationCampaignProvider $donation_campaign_provider
 * @property int $opportunity_scope_id
 * @property \App\Model\Entity\OpportunityScope $opportunity_scope
 * @property \Cake\I18n\Time $application_end_date
 * @property int $budget
 * @property int $currency_id
 * @property \App\Model\Entity\Currency $currency
 * @property int $seats
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \App\Model\Entity\OpportunityApplication[] $opportunity_applications
 * @property \App\Model\Entity\OpportunityCountry[] $opportunity_countries
 */
class Opportunity extends Entity
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
