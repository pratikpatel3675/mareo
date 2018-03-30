<?php
namespace App\Model\Table;

use App\Model\Entity\LostItem;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LostItems Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $ItemTypes
 * @property \Cake\ORM\Association\HasMany $ApplicantLostMaps
 * @property \Cake\ORM\Association\HasMany $ApplicantLostPictures
 * @property \Cake\ORM\Association\HasMany $ItemApplications
 */
class LostItemsTable extends Table
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

        $this->table('lost_items');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ItemTypes', [
            'foreignKey' => 'item_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ApplicantLostMaps', [
            'foreignKey' => 'lost_item_id'
        ]);
        $this->hasMany('ApplicantLostPictures', [
            'foreignKey' => 'lost_item_id'
        ]);
        $this->hasMany('ItemApplications', [
            'foreignKey' => 'lost_item_id'
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
            ->notEmpty('name');

        $validator
            ->notEmpty('description');

        $validator
            ->date('lost_date')
            ->notEmpty('lost_date');

        $validator
            ->integer('is_active')
            ->allowEmpty('is_active');

        $validator
            ->integer('last_status')
            ->allowEmpty('last_status');





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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['item_type_id'], 'ItemTypes'));
        return $rules;
    }
}
