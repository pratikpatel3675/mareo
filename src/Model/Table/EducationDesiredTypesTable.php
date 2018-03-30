<?php
namespace App\Model\Table;

use App\Model\Entity\EducationDesiredType;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EducationDesiredTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $ApplicantDesiredEducationTypes
 */
class EducationDesiredTypesTable extends Table
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

        $this->table('education_desired_types');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->hasMany('ApplicantDesiredEducationTypes', [
            'foreignKey' => 'education_desired_type_id'
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
