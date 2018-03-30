<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantEducation Entity.
 *
 * @property int $id
 * @property int $institution_higher_education_id
 * @property \App\Model\Entity\InstitutionHigherEducation $institution_higher_education
 * @property int $education_level_id
 * @property \App\Model\Entity\EducationLevel $education_level
 * @property int $education_isced_narrow_field_id
 * @property \App\Model\Entity\EducationIscedNarrowField $education_isced_narrow_field
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $year
 * @property int $has_evidence
 * @property int $language_id
 * @property \App\Model\Entity\Language $language
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $institution_higher_education_faculty_id
 * @property \App\Model\Entity\InstitutionHigherEducationFaculty $institution_higher_education_faculty
 * @property int $institution_higher_education_course_id
 * @property \App\Model\Entity\InstitutionHigherEducationCourse $institution_higher_education_course
 */
class ApplicantEducation extends Entity
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
