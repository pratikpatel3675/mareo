<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InstitutionHigherEducationFaculty Entity.
 *
 * @property int $id
 * @property int $institution_higher_education_id
 * @property \App\Model\Entity\InstitutionHigherEducation $institution_higher_education
 * @property string $name
 * @property string $type
 * @property \App\Model\Entity\ApplicantEducation[] $applicant_educations
 */
class InstitutionHigherEducationFaculty extends Entity
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
