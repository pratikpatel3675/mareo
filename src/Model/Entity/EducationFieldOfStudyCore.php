<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EducationFieldOfStudyCore Entity.
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ara
 * @property \App\Model\Entity\ApplicantOther[] $applicant_others
 * @property \App\Model\Entity\EducationFieldOfStudySub[] $education_field_of_study_subs
 * @property \App\Model\Entity\EducationIscedDetailedField[] $education_isced_detailed_fields
 * @property \App\Model\Entity\EducationIscedNarrowField[] $education_isced_narrow_fields
 */
class EducationFieldOfStudyCore extends Entity
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
