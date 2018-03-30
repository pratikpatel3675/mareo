<?php
namespace App\Model\Table;

use App\Model\Entity\ApplicantOther;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicantOthers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducations
 * @property \Cake\ORM\Association\BelongsTo $EducationFieldOfStudyCores
 */
class ApplicantOthersTable extends Table
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

        $this->table('applicant_others');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->integer('need_monthly_accomodation')
            ->requirePresence('need_monthly_accomodation', 'create')
            ->notEmpty('need_monthly_accomodation');

        $validator
            ->integer('need_monthly_meal_costs')
            ->requirePresence('need_monthly_meal_costs', 'create')
            ->notEmpty('need_monthly_meal_costs');

        $validator
            ->integer('need_tuition_fees')
            ->requirePresence('need_tuition_fees', 'create')
            ->notEmpty('need_tuition_fees');

        $validator
            ->integer('need_other_monthly_allowances')
            ->requirePresence('need_other_monthly_allowances', 'create')
            ->notEmpty('need_other_monthly_allowances');

        $validator
            ->integer('need_transport_fees')
            ->requirePresence('need_transport_fees', 'create')
            ->notEmpty('need_transport_fees');

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
        return $rules;
    }

    public function isOwnedBy($applicantOtherId, $userId)
    {
        return $this->exists(['id' => $applicantOtherId, 'user_id' => $userId]);
    }


    public function findOwnedBy(Query $query, array $options)
    {
        $userId = $options['user_id'];
        return $query->where(['user_id' => $userId]);
    }


}
