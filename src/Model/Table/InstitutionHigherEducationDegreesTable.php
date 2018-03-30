<?php
namespace App\Model\Table;

use App\Model\Entity\InstitutionHigherEducationDegree;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InstitutionHigherEducationDegrees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducations
 */
class InstitutionHigherEducationDegreesTable extends Table
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

        $this->table('institution_higher_education_degrees');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('InstitutionHigherEducations', [
            'foreignKey' => 'institution_higher_education_id'
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
        $rules->add($rules->existsIn(['institution_higher_education_id'], 'InstitutionHigherEducations'));
        return $rules;
    }
}
