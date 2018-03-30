<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'applicantProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//debug($countries->toArray());


echo $this->Html->script('applicantProfileEducationEdit', ['block' => 'scriptBottom']);

?>


<div class="applicantEducations form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantEducation) ?>
    <fieldset>
        <legend><?= __('Edit Applicant Education') ?></legend>
        <?php
            echo $this->Form->input('education_level_id', ['options' => $educationLevels, 'id' => 'selector_education_level']);
            //echo $this->Form->input('education_isced_narrow_field_id', ['options' => $educationIscedNarrowFields, 'empty' => true]);
            echo $this->Form->input('country_id', ['options' => $countries, 'id' => 'selector_education_country']);
            echo $this->Form->input('year');
            echo $this->Form->input('has_evidence', ['options' => ['0' => __('No'), '1' => __('yes')], 'label' => ['text' => __('Has Education Evidence')]]);
            echo $this->Form->input('language_id', ['options' => $languages]);
            echo $this->Form->input('it_skills_rating', ['options' => ['1' => __('Poor'), '2' => __('Fair'), '3' => __('Good'), '4' => __('Excellent')], 'label' => ['text' => __('IT Skills Rating')]]);
            //echo $this->Form->input('user_id', ['options' => $users]);
        ?>
        <div id='institution-panel'>
        <?php    
            echo $this->Form->input('institution_higher_education_id', ['options' => $institutionHigherEducations, 'id' => 'selector_education_institution', 'empty' => true]);
            echo $this->Form->input('institution_higher_education_faculty_id', ['options' => $institutionHigherEducationFaculties, 'id' => 'selector_education_faculty', 'empty' => true]);
            echo $this->Form->input('institution_higher_education_course_id', ['options' => $institutionHigherEducationCourses, 'id' => 'selector_education_course', 'empty' => true]);
        ?>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
