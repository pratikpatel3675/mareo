<?php
namespace App\Model\Table;

use App\Model\Entity\EducationFieldOfStudyCore;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EducationFieldOfStudyCores Model
 *
 * @property \Cake\ORM\Association\HasMany $ApplicantOthers
 * @property \Cake\ORM\Association\HasMany $EducationFieldOfStudySubs
 * @property \Cake\ORM\Association\HasMany $EducationIscedDetailedFields
 * @property \Cake\ORM\Association\HasMany $EducationIscedNarrowFields
 */
class EducationFieldOfStudyCoresTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('education_field_of_study_cores');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->hasMany('ApplicantOthers', [
            'foreignKey' => 'education_field_of_study_core_id'
        ]);
        $this->hasMany('EducationFieldOfStudySubs', [
            'foreignKey' => 'education_field_of_study_core_id'
        ]);
        $this->hasMany('EducationIscedDetailedFields', [
            'foreignKey' => 'education_field_of_study_core_id'
        ]);
        $this->hasMany('EducationIscedNarrowFields', [
            'foreignKey' => 'education_field_of_study_core_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('name_en');

        $validator
            ->allowEmpty('name_ara');

        return $validator;
    }
}
