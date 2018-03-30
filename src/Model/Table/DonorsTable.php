<?php
namespace App\Model\Table;

use App\Model\Entity\Donor;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Donors Model
 *
 * @property \Cake\ORM\Association\BelongsTo $DonorTypes
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $DonationCampaigns
 * @property \Cake\ORM\Association\HasMany $DonorUsers
 * @property \Cake\ORM\Association\HasMany $Opportunity
 */
class DonorsTable extends Table
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

        $this->table('donors');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('DonorTypes', [
            'foreignKey' => 'donor_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('DonationCampaigns', [
            'foreignKey' => 'donor_id'
        ]);
        $this->hasMany('DonerUsers', [
            'foreignKey' => 'donor_id'
        ]);
        $this->hasMany('Opportunity', [
            'foreignKey' => 'donor_id'
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'donor_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'donor_users'
        ]);

        $this->belongsToMany('ImplementingProviders', [
            'className' => 'Providers',
            'foreignKey' => 'donor_id',
            'targetForeignKey' => 'provider_id',
            'joinTable' => 'donation_campaign_providers',
            'propertyName' => 'implementing_providers'
        ]);

        $this->belongsToMany('ImplementingProviderOffices', [
            'className' => 'ProviderOffices',
            'foreignKey' => 'donor_id',
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
            ->allowEmpty('addr_line1');

        $validator
            ->allowEmpty('addr_line2');

        $validator
            ->allowEmpty('addr_line3');

        $validator
            ->allowEmpty('phone');

        $validator
            ->allowEmpty('fax');

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
        $rules->add($rules->existsIn(['donor_type_id'], 'DonorTypes'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        return $rules;
    }
}
