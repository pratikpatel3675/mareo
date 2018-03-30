<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicantDesiredInstitution;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantDesiredInstitutions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducations
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducationFaculties
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducationCourses
 */
class ApplicantDesiredInstitutionsTable extends Table
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

        $this->table('applicant_desired_institutions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('InstitutionHigherEducations', [
            'foreignKey' => 'institution_higher_education_id'
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
            ->integer('is_already_registered')
            ->allowEmpty('is_already_registered');

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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['institution_higher_education_id'], 'InstitutionHigherEducations'));
        $rules->add($rules->existsIn(['institution_higher_education_faculty_id'], 'InstitutionHigherEducationFaculties'));
        $rules->add($rules->existsIn(['institution_higher_education_course_id'], 'InstitutionHigherEducationCourses'));
        return $rules;
    }

    public function isOwnedBy($applicantDesiredInstitutionId, $userId)
    {
        return $this->exists(['id' => $applicantDesiredInstitutionId, 'user_id' => $userId]);
    }


    public function findOwnedBy(Query $query, array $options)
    {
        $userId = $options['user_id'];
        return $query->where(['user_id' => $userId]);
    }

    public function alreadyExists($countryId, $userId, $institutionId, $facultyId, $courseId)
    {
        return $this->exists([
            'country_id' => $countryId,
            'user_id' => $userId,
            'institution_higher_education_id' => $institutionId,
            'institution_higher_education_faculty_id' => $facultyId,
            'institution_higher_education_course_id' => $courseId
            ]);
    }




}
