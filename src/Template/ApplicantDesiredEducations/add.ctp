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

echo $this->Html->script('applicantProfileDesiredEducationAdd', ['block' => 'scriptBottom']);

?>

<div class="applicantDesiredEducations form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantDesiredEducation) ?>
    <fieldset>
        <legend><?= __('Add_Applicant_Desired_Education') ?></legend>
        <?php
            // Those 2 fields are used only for javascript cascade select.
            echo $this->Form->input('education_field_of_study_core_id', ['options' => $educationFieldOfStudyCores, 'id' => 'core']);
            echo $this->Form->input('education_isced_narrow_field_id', ['options' => $educationIscedNarrowFields, 'id' => 'narrow']);
            //
            echo $this->Form->input('education_field_of_study_sub_id', ['options' => $educationFieldOfStudySubs, 'id' => 'sub','empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
