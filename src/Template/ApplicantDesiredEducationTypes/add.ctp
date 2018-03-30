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

?>

<div class="applicantDesiredEducationTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantDesiredEducationType) ?>
    <fieldset>
        <legend><?= __('Add_Applicant_Desired_Education_Type') ?></legend>
        <?php
            echo $this->Form->input('education_desired_type_id', ['options' => $educationDesiredTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
