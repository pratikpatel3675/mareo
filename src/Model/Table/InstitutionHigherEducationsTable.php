<?php
namespace App\Model\Table;

use App\Model\Entity\InstitutionHigherEducation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InstitutionHigherEducations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $InstitutionTypes
 * @property \Cake\ORM\Association\HasMany $ApplicantEducations
 * @property \Cake\ORM\Association\HasMany $ApplicantOthers
 * @property \Cake\ORM\Association\HasMany $InstitutionHigherEducationDegrees
 * @property \Cake\ORM\Association\HasMany $InstitutionHigherEducationFaculties
 */
class InstitutionHigherEducationsTable extends Table
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

        $this->table('institution_higher_educations');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('InstitutionTypes', [
            'foreignKey' => 'institution_type_id'
        ]);
        $this->hasMany('ApplicantEducations', [
            'foreignKey' => 'institution_higher_education_id'
        ]);
        $this->hasMany('ApplicantOthers', [
            'foreignKey' => 'institution_higher_education_id'
        ]);
        $this->hasMany('InstitutionHigherEducationDegrees', [
            'foreignKey' => 'institution_higher_education_id'
        ]);
        $this->hasMany('InstitutionHigherEducationFaculties', [
            'foreignKey' => 'institution_higher_education_id'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('street');

        $validator
            ->allowEmpty('city');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('fax');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('website');

        $validator
            ->allowEmpty('type');

        $validator
            ->allowEmpty('description');

        $validator
            ->allowEmpty('academic_year');

        $validator
            ->allowEmpty('requirements');

        $validator
            ->allowEmpty('head_name');

        $validator
            ->allowEmpty('administration_name');

        $validator
            ->allowEmpty('international_relations_name');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['institution_type_id'], 'InstitutionTypes'));
        return $rules;
    }
}
