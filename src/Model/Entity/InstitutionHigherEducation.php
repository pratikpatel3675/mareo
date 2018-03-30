<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InstitutionHigherEducation Entity.
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property string $street
 * @property string $city
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $website
 * @property string $type
 * @property string $description
 * @property string $academic_year
 * @property string $requirements
 * @property string $head_name
 * @property string $administration_name
 * @property string $international_relations_name
 * @property int $institution_type_id
 * @property \App\Model\Entity\InstitutionType $institution_type
 * @property int $status
 * @property \App\Model\Entity\ApplicantEducation[] $applicant_educations
 * @property \App\Model\Entity\ApplicantOther[] $applicant_others
 * @property \App\Model\Entity\InstitutionHigherEducationDegree[] $institution_higher_education_degrees
 * @property \App\Model\Entity\InstitutionHigherEducationFaculty[] $institution_higher_education_faculties
 */
class InstitutionHigherEducation extends Entity
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
