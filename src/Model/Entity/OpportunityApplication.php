<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OpportunityApplication Entity.
 *
 * @property int $id
 * @property int $applicant_user_id
 * @property \App\Model\Entity\ApplicantUser $applicant_user
 * @property int $opportunity_id
 * @property \App\Model\Entity\Opportunity $opportunity
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $opportuntity_application_status_id
 * @property \App\Model\Entity\OpportuntityApplicationStatus $opportuntity_application_status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class OpportunityApplication extends Entity
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
