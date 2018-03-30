<?php
namespace App\Model\Table;

use App\Model\Entity\OpportunityScope;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OpportunityScopes Model
 *
 * @property \Cake\ORM\Association\HasMany $Opportunities
 */
class OpportunityScopesTable extends Table
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

        $this->table('opportunity_scopes');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Opportunities', [
            'foreignKey' => 'opportunity_scope_id'
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

        return $validator;
    }
}
