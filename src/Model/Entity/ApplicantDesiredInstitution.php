<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantDesiredInstitution Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $institution_higher_education_id
 * @property \App\Model\Entity\InstitutionHigherEducation $institution_higher_education
 * @property int $institution_higher_education_faculty_id
 * @property \App\Model\Entity\InstitutionHigherEducationFaculty $institution_higher_education_faculty
 * @property int $institution_higher_education_course_id
 * @property \App\Model\Entity\InstitutionHigherEducationCourse $institution_higher_education_course
 * @property int $is_already_registered
 */
class ApplicantDesiredInstitution extends Entity
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
