<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\error\Debugger;

/**
 * Users Model
 *
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);

        $this->hasOne('ApplicantAdresses');
      //  $this->hasMany('ApplicantDesiredCountries');
       // $this->hasMany('ApplicantDesiredEducations');
       // $this->hasMany('ApplicantDesiredEducationTypes');
       // $this->hasOne('ApplicantEducations');
        $this->hasOne('ApplicantGenerals');
        //$this->hasMany('ApplicantLanguages');
        //$this->hasMany('ApplicantNationalities');
        //$this->hasOne('ApplicantOthers');
        //$this->hasMany('ApplicantTravelDocuments');
        //$this->hasMany('Donor_users');
  







    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
       
 $validator->add('confirm_password', [
    'compare' => [
        'rule' => ['compareWith', 'password'],
        'message' => 'The passwords are not matching. Please, retype passwords.'
    ]
])
->add('confirm_email', [
    'compare' => [
        'rule' => ['compareWith', 'email'],
        'message' => 'The E-mails are not matching. Please, retype E-mail.'
    ]
])

            ->notEmpty('email', __('email'))
            ->notEmpty('password', __('password_required'))
            ->notEmpty('role', __('role_required'))
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'applicant', 'provider']],
                'message' => 'Please enter a valid role'
            ])
            ->add('email', 'valid-email', ['rule' => 'email']);


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

        return $rules;
    }


    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        $query
        ->select(['id', 'email', 'password', 'role'])
        ->where(['Users.active' => 1]);

        return $query;
    }

}
