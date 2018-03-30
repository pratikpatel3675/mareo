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


//echo debug($applicantGeneral);


?>


<div class="applicantOthers form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantOther) ?>
    <fieldset>
        <legend><?= __('Add_Applicant_Other') ?></legend>
        <?php
            echo $this->Form->input('need_monthly_accomodation', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Need_Monthly_Accomodation')]]);
            echo $this->Form->input('need_monthly_meal_costs', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Need_Monthly_Meal_Costs')]]);
            echo $this->Form->input('need_other_monthly_allowances', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Need_Other_Monthly_Allowances')]]);
            echo $this->Form->input('need_tuition_fees', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Need_Tuition_Fees')]]);
            echo $this->Form->input('need_transport_fees', ['options' => ['0' => __('No'), '1' => __('Yes')], 'label' => ['text' => __('Need_Transport_Fees')]]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
