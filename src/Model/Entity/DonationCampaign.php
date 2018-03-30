<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DonationCampaign Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $donor_id
 * @property \App\Model\Entity\Donor $donor
 * @property int $budget
 * @property int $currency_id
 * @property \App\Model\Entity\Currency $currency
 * @property \App\Model\Entity\Opportunity[] $opportunity
 */
class DonationCampaign extends Entity
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
