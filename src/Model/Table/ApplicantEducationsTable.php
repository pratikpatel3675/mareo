<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicantEducation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantEducations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducations
 * @property \Cake\ORM\Association\BelongsTo $EducationLevels
 * @property \Cake\ORM\Association\BelongsTo $EducationIscedNarrowFields
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $Languages
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducationFaculties
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducationCourses
 */
class ApplicantEducationsTable extends Table
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

        $this->table('applicant_educations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('InstitutionHigherEducations', [
            'foreignKey' => 'institution_higher_education_id'
        ]);
        $this->belongsTo('EducationLevels', [
            'foreignKey' => 'education_level_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EducationIscedNarrowFields', [
            'foreignKey' => 'education_isced_narrow_field_id'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Languages', [
            'foreignKey' => 'language_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('InstitutionHigherEducationFaculties', [
            'foreignKey' => 'institution_higher_education_faculty_id'
        ]);
        $this->belongsTo('InstitutionHigherEducationCourses', [
            'foreignKey' => 'institution_higher_education_course_id'
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
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year')
            ->range('year', [2000, 2016]);

        $validator
            ->integer('has_evidence')
            ->requirePresence('has_evidence', 'create')
            ->notEmpty('has_evidence');

        $validator
            ->integer('it_skills_rating')
            ->requirePresence('it_skills_rating', 'create')
            ->notEmpty('it_skills_rating');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['institution_higher_education_id'], 'InstitutionHigherEducations'));
        $rules->add($rules->existsIn(['education_level_id'], 'EducationLevels'));
        $rules->add($rules->existsIn(['education_isced_narrow_field_id'], 'EducationIscedNarrowFields'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['language_id'], 'Languages'));
        $rules->add($rules->existsIn(['institution_higher_education_faculty_id'], 'InstitutionHigherEducationFaculties'));
        $rules->add($rules->existsIn(['institution_higher_education_course_id'], 'InstitutionHigherEducationCourses'));
        return $rules;
    }

    public function isOwnedBy($applicantEducationId, $userId)
    {
        return $this->exists(['id' => $applicantEducationId, 'user_id' => $userId]);
    }


    public function findOwnedBy(Query $query, array $options)
    {
        $userId = $options['user_id'];
        return $query->where(['user_id' => $userId]);
    }



}
