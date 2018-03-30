<?php
namespace App\Model\Table;

use App\Model\Entity\Provider;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Providers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ProviderTypes
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Opportunities
 * @property \Cake\ORM\Association\HasMany $ProviderOffices
 * @property \Cake\ORM\Association\HasMany $ProviderUsers
 */
class ProvidersTable extends Table
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

        $this->table('providers');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ProviderTypes', [
            'foreignKey' => 'provider_type_id'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Opportunities', [
            'foreignKey' => 'provider_id'
        ]);
        $this->hasMany('ProviderOffices', [
            'foreignKey' => 'provider_id'
        ]);
        $this->hasMany('ProviderUsers', [
            'foreignKey' => 'provider_id'
        ]);

        $this->belongsToMany('FundingDonors', [
            'className' => 'Donors',
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'donor_id',
            'joinTable' => 'donation_campaign_providers',
            'propertyName' => 'funding_donors'
        ]);

        $this->belongsToMany('ImplementedDonationCampaigns', [
            'className' => 'DonationCampaings',
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'donation_campaign_id',
            'joinTable' => 'donation_campaign_providers',
            'propertyName' => 'implemented_donation_campaigns'
        ]);
        $this->belongsToMany('ImplementingProviderOffices', [
            'className' => 'ProviderOffices',
            'foreignKey' => 'provider_id',
            'targetForeignKey' => 'provider_office_id',
            'joinTable' => 'donation_campaign_providers',
            'propertyName' => 'implementing_provider_offices'
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
            ->allowEmpty('website');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('description_en');

        $validator
            ->allowEmpty('description_ara');

        $validator
            ->allowEmpty('logo_filename');

        $validator
            ->allowEmpty('hq_addr_line1');

        $validator
            ->allowEmpty('hq_addr_line2');

        $validator
            ->allowEmpty('hq_addr_line3');

        $validator
            ->allowEmpty('hq_phone');

        $validator
            ->allowEmpty('hq_fax');

        $validator
            ->allowEmpty('city');

        $validator
            ->integer('postcode')
            ->allowEmpty('postcode');

        $validator
            ->integer('is_active')
            ->allowEmpty('is_active');

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
        $rules->add($rules->existsIn(['provider_type_id'], 'ProviderTypes'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
}
