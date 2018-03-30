<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EducationIscedNarrowField Entity.
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ara
 * @property int $education_field_of_study_core_id
 * @property \App\Model\Entity\EducationFieldOfStudyCore $education_field_of_study_core
 * @property \App\Model\Entity\ApplicantEducation[] $applicant_educations
 * @property \App\Model\Entity\EducationFieldOfStudySub[] $education_field_of_study_subs
 * @property \App\Model\Entity\EducationIscedDetailedField[] $education_isced_detailed_fields
 * @property \App\Model\Entity\InstitutionHigherEducationCourse[] $institution_higher_education_courses
 */
class EducationIscedNarrowField extends Entity
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
