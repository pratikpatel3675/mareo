<?php
namespace App\Model\Table;

use App\Model\Entity\DonationCampaignProvider;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DonationCampaignProviders Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Donors
 * @property \Cake\ORM\Association\BelongsTo $DonationCampaigns
 * @property \Cake\ORM\Association\BelongsTo $Providers
 * @property \Cake\ORM\Association\BelongsTo $ProviderOffices
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 */
class DonationCampaignProvidersTable extends Table
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

        $this->table('donation_campaign_providers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Donors', [
            'foreignKey' => 'donor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DonationCampaigns', [
            'foreignKey' => 'donation_campaign_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ProviderOffices', [
            'foreignKey' => 'provider_office_id'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id'
        ]);
        $this->hasMany('Opportunities', [
            'foreignKey' => 'donation_campaign_provider_id'
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
            ->date('start_date')
            ->allowEmpty('start_date');

        $validator
            ->date('end_date')
            ->allowEmpty('end_date');

        $validator
            ->integer('budget')
            ->allowEmpty('budget');

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
        $rules->add($rules->existsIn(['donor_id'], 'Donors'));
        $rules->add($rules->existsIn(['donation_campaign_id'], 'DonationCampaigns'));
        $rules->add($rules->existsIn(['provider_office_id'], 'ProviderOffices'));
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));
        return $rules;
    }
}
