<?php
namespace App\Model\Table;

use App\Model\Entity\InstitutionHigherEducationCourse;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InstitutionHigherEducationCourses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $InstitutionHigherEducationFaculities
 * @property \Cake\ORM\Association\BelongsTo $EducationIscedNarrowFields
 * @property \Cake\ORM\Association\HasMany $ApplicantEducations
 */
class InstitutionHigherEducationCoursesTable extends Table
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

        $this->table('institution_higher_education_courses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('InstitutionHigherEducationFaculties', [
            'foreignKey' => 'institution_higher_education_faculty_id'
        ]);
        $this->belongsTo('EducationIscedNarrowFields', [
            'foreignKey' => 'education_isced_narrow_field_id'
        ]);
        $this->hasMany('ApplicantEducations', [
            'foreignKey' => 'institution_higher_education_course_id'
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
        $rules->add($rules->existsIn(['institution_higher_education_faculty_id'], 'InstitutionHigherEducationFaculties'));
        $rules->add($rules->existsIn(['education_isced_narrow_field_id'], 'EducationIscedNarrowFields'));
        return $rules;
    }
}
