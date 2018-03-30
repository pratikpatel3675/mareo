<?php
namespace App\Model\Table;

use App\Model\Entity\EducationFieldOfStudySub;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EducationFieldOfStudySubs Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EducationFieldOfStudyCores
 * @property \Cake\ORM\Association\BelongsTo $EducationIscedNarrowFields
 * @property \Cake\ORM\Association\HasMany $ApplicantDesiredEducations
 */
class EducationFieldOfStudySubsTable extends Table
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

        $this->table('education_field_of_study_subs');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->belongsTo('EducationFieldOfStudyCores', [
            'foreignKey' => 'education_field_of_study_core_id'
        ]);
        $this->belongsTo('EducationIscedNarrowFields', [
            'foreignKey' => 'education_isced_narrow_field_id'
        ]);
        $this->hasMany('ApplicantDesiredEducations', [
            'foreignKey' => 'education_field_of_study_sub_id'
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

        $validator
            ->allowEmpty('type');

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
        $rules->add($rules->existsIn(['education_isced_narrow_field_id'], 'EducationIscedNarrowFields'));
        return $rules;
    }
}
