<?php
namespace App\Model\Table;

use App\Model\Entity\Country;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 */
class CountriesTable extends Table
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

        $this->table('countries');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Users');
        $this->hasMany('ApplicantDesiredEducations');

        $this->hasMany('ApplicantOthers');
        $this->hasMany('ApplicantTravelDocuments');
        $this->hasMany('Donors');
        $this->hasMany('InstitutionsHigherEducations');

        $this->hasMany('OpportunityCountries');
        $this->belongsToMany('Opportunities', [
            'foreignKey' => 'country_id',
            'targetForeignKey' => 'opportunity_id',
            'joinTable' => 'opportunity_countries'
        ]);

        $this->hasMany('OpportunityApplications');

        $this->hasMany('ProviderOffices');
        $this->hasMany('Providers');

        $this->belongsToMany('ProviderOfficesWithOpportunities', [
            'className' => 'ProviderOffices',
            'foreignKey' => 'country_id',
            'targetForeignKey' => 'provider_office_id',
            'joinTable' => 'opportunity_countries',
            'propertyName' => 'provider_offices_with_opportunities'
        ]);

        $this->belongsToMany('OpportunityApplicantUsers', [
            'className' => 'Users',
            'foreignKey' => 'country_id',
            'targetForeignKey' => 'applicant_user_id',
            'joinTable' => 'opportunity_applications',
            'propertyName' => 'opportunity_applicant_users'
        ]);

        $this->belongsToMany('AppliedOpportunites', [
            'className' => 'Oportunities',
            'foreignKey' => 'country_id',
            'targetForeignKey' => 'opportunity_id',
            'joinTable' => 'opportunity_applications',
            'propertyName' => 'applied_opportunities'
        ]);

           $this->hasMany('LostItems', [
            'foreignKey' => 'country_id'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->requirePresence('name_en', 'create')
            ->notEmpty('name_en');

        $validator
            ->requirePresence('name_ara', 'create')
            ->notEmpty('name_ara');

        $validator
            ->decimal('latitude')
            ->allowEmpty('latitude');

        $validator
            ->decimal('longitude')
            ->allowEmpty('longitude');

        $validator
            ->allowEmpty('title1_en');

        $validator
            ->allowEmpty('title1_ara');

        $validator
            ->allowEmpty('text1_en');

        $validator
            ->allowEmpty('text1_ara');

        $validator
            ->allowEmpty('title2_en');

        $validator
            ->allowEmpty('title2_ara');

        $validator
            ->allowEmpty('text2_en');

        $validator
            ->allowEmpty('text2_ara');

        $validator
            ->allowEmpty('title3_en');

        $validator
            ->allowEmpty('title3_ara');

        $validator
            ->allowEmpty('text3_en');

        $validator
            ->allowEmpty('text3_ara');

        return $validator;
    }


    
}
