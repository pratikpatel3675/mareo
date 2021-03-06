<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EducationFieldOfStudySub Entity.
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ara
 * @property string $type
 * @property int $education_field_of_study_core_id
 * @property \App\Model\Entity\EducationFieldOfStudyCore $education_field_of_study_core
 * @property int $education_isced_narrow_field_id
 * @property \App\Model\Entity\EducationIscedNarrowField $education_isced_narrow_field
 * @property \App\Model\Entity\ApplicantDesiredEducation[] $applicant_desired_educations
 */
class EducationFieldOfStudySub extends Entity
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
