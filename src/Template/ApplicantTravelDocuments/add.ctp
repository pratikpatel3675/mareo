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

?>

<div class="applicantTravelDocuments form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantTravelDocument) ?>
    <fieldset>
        <legend><?= __('Add_Applicant_Travel_Document') ?></legend>
        <?php
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('has_valid_visa', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Has_Valid_Visa')]]);
            echo $this->Form->input('has_study_permit', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Has_Study_Permit')]]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
