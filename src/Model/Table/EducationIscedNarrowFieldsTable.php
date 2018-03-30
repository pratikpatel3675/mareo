<?php
namespace App\Model\Table;

use App\Model\Entity\EducationIscedNarrowField;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EducationIscedNarrowFields Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EducationFieldOfStudyCores
 * @property \Cake\ORM\Association\HasMany $ApplicantEducations
 * @property \Cake\ORM\Association\HasMany $EducationFieldOfStudySubs
 * @property \Cake\ORM\Association\HasMany $EducationIscedDetailedFields
 * @property \Cake\ORM\Association\HasMany $InstitutionHigherEducationCourses
 */
class EducationIscedNarrowFieldsTable extends Table
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

        $this->table('education_isced_narrow_fields');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->belongsTo('EducationFieldOfStudyCores', [
            'foreignKey' => 'education_field_of_study_core_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplicantEducations', [
            'foreignKey' => 'education_isced_narrow_field_id'
        ]);
        $this->hasMany('EducationFieldOfStudySubs', [
            'foreignKey' => 'education_isced_narrow_field_id'
        ]);
        $this->hasMany('EducationIscedDetailedFields', [
            'foreignKey' => 'education_isced_narrow_field_id'
        ]);
        $this->hasMany('InstitutionHigherEducationCourses', [
            'foreignKey' => 'education_isced_narrow_field_id'
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
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->requirePresence('name_ara', 'create')
            ->notEmpty('name_ara');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['education_field_of_study_core_id'], 'EducationFieldOfStudyCores'));
        return $rules;
    }
}
