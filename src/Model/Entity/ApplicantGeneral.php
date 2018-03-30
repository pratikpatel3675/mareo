<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantGeneral Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $unhcr_id
 * @property \App\Model\Entity\Unhcr $unhcr
 * @property string $unrwa_id
 * @property \App\Model\Entity\Unrwa $unrwa
 * @property string $fisrtname
 * @property string $lastname
 * @property string $fathername
 * @property int $gender_id
 * @property \App\Model\Entity\Gender $gender
 * @property \Cake\I18n\Time $birthdate
 * @property int $nationality_id
 * @property \App\Model\Entity\Nationality $nationality
 * @property int $marital_status
 * @property int $dependants_count
 * @property int $has_disability
 * @property string $disability_description
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class ApplicantGeneral extends Entity
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
