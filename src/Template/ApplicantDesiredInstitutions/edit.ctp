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
        <legend><?= __('Edit Applicant Desired Institution') ?></legend>
        <table class="table">
            <tr>
                <th><?= __('Institution Higher Education') ?></th>
                <td><?= $applicantDesiredInstitution->has('institution_higher_education') ? h($applicantDesiredInstitution->institution_higher_education->name) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Institution Higher Education Faculty') ?></th>
                <td><?= $applicantDesiredInstitution->has('institution_higher_education_faculty') ? h($applicantDesiredInstitution->institution_higher_education_faculty->name) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Institution Higher Education Course') ?></th>
                <td><?= $applicantDesiredInstitution->has('institution_higher_education_course') ? h($applicantDesiredInstitution->institution_higher_education_course->name) : '' ?></td>
            </tr>
        </table>
        <?php
            //echo $this->Form->input('country_id', ['options' => $countries, 'id' => 'selector_education_country']);
            //echo $this->Form->input('institution_higher_education_id', ['options' => $institutionHigherEducations, 'id' => 'selector_education_institution', 'empty' => true]);
            //echo $this->Form->input('institution_higher_education_faculty_id', ['options' => $institutionHigherEducationFaculties, 'id' => 'selector_education_faculty', 'empty' => true]);
            //echo $this->Form->input('institution_higher_education_course_id', ['options' => $institutionHigherEducationCourses, 'id' => 'selector_education_course','empty' => true]);
            echo $this->Form->input('is_already_registered', ['options' => ['0' => __('No'), '1' => __('yes')], 'label' => ['text' => __('Is Already Registered')]]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
