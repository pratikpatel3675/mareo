<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InstitutionHigherEducationCourse Entity.
 *
 * @property int $id
 * @property int $institution_higher_education_faculity_id
 * @property \App\Model\Entity\InstitutionHigherEducationFaculity $institution_higher_education_faculity
 * @property string $name
 * @property int $education_isced_narrow_field_id
 * @property \App\Model\Entity\EducationIscedNarrowField $education_isced_narrow_field
 * @property \App\Model\Entity\ApplicantEducation[] $applicant_educations
 */
class InstitutionHigherEducationCourse extends Entity
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
