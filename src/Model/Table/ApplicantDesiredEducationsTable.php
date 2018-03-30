<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicantDesiredEducation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantDesiredEducations Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $EducationFieldOfStudySubs
 */
class ApplicantDesiredEducationsTable extends Table
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

        $this->table('applicant_desired_educations');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EducationFieldOfStudySubs', [
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
        $rules->add($rules->existsIn(['education_field_of_study_sub_id'], 'EducationFieldOfStudySubs'));
        return $rules;
    }

    public function isOwnedBy($applicantDesiredEducationId, $userId)
    {
        return $this->exists(['id' => $applicantDesiredEducationId, 'user_id' => $userId]);
    }


    public function findOwnedBy(Query $query, array $options)
    {
        $userId = $options['user_id'];
        return $query->where(['user_id' => $userId]);
    }

    public function alreadyExists($educationFieldOfStudySubId, $userId)
    {
        return $this->exists(['education_field_of_study_sub_id' => $educationFieldOfStudySubId, 'user_id' => $userId]);
    }


}
