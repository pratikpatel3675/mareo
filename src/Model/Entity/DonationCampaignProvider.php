<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DonationCampaignProvider Entity.
 *
 * @property int $id
 * @property int $donor_id
 * @property \App\Model\Entity\Donor $donor
 * @property int $donation_campaign_id
 * @property \App\Model\Entity\DonationCampaign $donation_campaign
 * @property int $provider_id
 * @property \App\Model\Entity\Provider $provider
 * @property int $provider_office_id
 * @property \App\Model\Entity\ProviderOffice $provider_office
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property int $budget
 * @property int $currency_id
 * @property \App\Model\Entity\Currency $currency
 */
class DonationCampaignProvider extends Entity
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
