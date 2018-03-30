<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantOther Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $it_skills_rating
 * @property int $need_for_preparatory_course
 * @property int $is_already_registered
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $institution_higher_education_id
 * @property \App\Model\Entity\InstitutionHigherEducation $institution_higher_education
 * @property int $education_field_of_study_core_id
 * @property \App\Model\Entity\EducationFieldOfStudyCore $education_field_of_study_core
 * @property int $need_monthly_accomodation
 * @property int $need_monthly_meal_costs
 * @property int $need_tuition_fees
 * @property int $need_other_monthly_allowances
 * @property int $need_transport_fees
 * @property int $need_other
 */
class ApplicantOther extends Entity
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
