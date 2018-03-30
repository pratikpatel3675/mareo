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

<div class="applicantDesiredInstitutions form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantDesiredInstitution) ?>
    <fieldset>
        <legend><?= __('Edit_Applicant_Desired_Institution') ?></legend>
        <?php
            echo $this->Form->input('country_id', ['options' => $countries, 'id' => 'selector_education_country']);
            echo $this->Form->input('institution_higher_education_id', ['options' => $institutionHigherEducations, 'id' => 'selector_education_institution', 'empty' => true]);
            echo $this->Form->input('institution_higher_education_faculty_id', ['options' => $institutionHigherEducationFaculties, 'id' => 'selector_education_faculty', 'empty' => true]);
            echo $this->Form->input('institution_higher_education_course_id', ['options' => $institutionHigherEducationCourses, 'id' => 'selector_education_course','empty' => true]);
            echo $this->Form->input('is_already_registered', ['options' => ['0' => __('No'), '1' => __('yes')], 'label' => ['text' => __('Is_Already_Registered')]]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
