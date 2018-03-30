<?php
namespace App\Model\Table;

use App\Model\Entity\DonationCampaign;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DonationCampaigns Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Donors
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\HasMany $Opportunity
 */
class DonationCampaignsTable extends Table
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

        $this->table('donation_campaigns');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Donors', [
            'foreignKey' => 'donor_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Opportunities', [
            'foreignKey' => 'donation_campaign_id'
        ]);

        $this->belongsToMany('Providers', [
            'foreignKey' => 'donation_campaign_id',
            'targetForeignKey' => 'provider_id',
            'joinTable' => 'opportunities'
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
            ->allowEmpty('description');

        $validator
            ->integer('budget')
            ->requirePresence('budget', 'create')
            ->notEmpty('budget');

        $validator
            ->allowEmpty('requirements');

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
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));
        return $rules;
    }
}
