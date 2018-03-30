<?php
namespace App\Model\Table;

use App\Model\Entity\ProviderOfficeUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProviderOfficeUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ProviderOffices
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class ProviderOfficeUsersTable extends Table
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

        $this->table('provider_office_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ProviderOffices', [
            'foreignKey' => 'provider_office_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
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
        $rules->add($rules->existsIn(['provider_office_id'], 'ProviderOffices'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }

    public function isOwnedBy($provider_office_id, $userId)
    {
        return $this->exists(['provider_office_id' => $provider_office_id, 'user_id' => $userId]);
    }


    public function findOwnedBy(Query $query, array $options)
    {
        $userId = $options['user_id'];
        return $query->where(['user_id' => $userId]);
    }


}
