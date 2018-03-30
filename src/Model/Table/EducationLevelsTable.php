<?php
namespace App\Model\Table;

use App\Model\Entity\EducationLevel;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EducationLevels Model
 *
 * @property \Cake\ORM\Association\HasMany $ApplicantEducations
 */
class EducationLevelsTable extends Table
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

        $this->table('education_levels');
        $this->displayField('name_en');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ApplicantEducations', [
            'foreignKey' => 'education_level_id'
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
