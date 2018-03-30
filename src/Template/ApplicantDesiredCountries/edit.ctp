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

<div class="applicantDesiredCountries form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantDesiredCountry) ?>
    <fieldset>
        <legend><?= __('Edit_Applicant_Desired_Country') ?></legend>
        <?php
            echo $this->Form->input('country_id', ['options' => $countries]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
