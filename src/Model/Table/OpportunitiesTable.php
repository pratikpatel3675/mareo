<?php
namespace App\Model\Table;

use App\Model\Entity\Opportunity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Opportunities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $OpportunityDurations
 * @property \Cake\ORM\Association\BelongsTo $EducationDesiredTypes
 * @property \Cake\ORM\Association\BelongsTo $DonationCampaignProviders
 * @property \Cake\ORM\Association\BelongsTo $OpportunityScopes
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\HasMany $OpportunityApplications
 * @property \Cake\ORM\Association\HasMany $OpportunityCountries
 */
class OpportunitiesTable extends Table
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

        $this->table('opportunities');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('OpportunityDurations', [
            'foreignKey' => 'opportunity_duration_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EducationDesiredTypes', [
            'foreignKey' => 'education_desired_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DonationCampaignProviders', [
            'foreignKey' => 'donation_campaign_provider_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OpportunityScopes', [
            'foreignKey' => 'opportunity_scope_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id'
        ]);
        $this->hasMany('OpportunityApplications', [
            'foreignKey' => 'opportunity_id'
        ]);
        $this->hasMany('OpportunityCountries', [
            'foreignKey' => 'opportunity_id'
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
            ->allowEmpty('name_en');

        $validator
            ->allowEmpty('name_ara');

        $validator
            ->allowEmpty('description_en');

        $validator
            ->allowEmpty('description_ara');

        $validator
            ->date('application_end_date')
            ->allowEmpty('application_end_date');

        $validator
            ->integer('budget')
            ->allowEmpty('budget');

        $validator
            ->integer('seats')
            ->allowEmpty('seats');

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
        $rules->add($rules->existsIn(['opportunity_duration_id'], 'OpportunityDurations'));
        $rules->add($rules->existsIn(['education_desired_type_id'], 'EducationDesiredTypes'));
        $rules->add($rules->existsIn(['donation_campaign_provider_id'], 'DonationCampaignProviders'));
        $rules->add($rules->existsIn(['opportunity_scope_id'], 'OpportunityScopes'));
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));
        return $rules;
    }
}
