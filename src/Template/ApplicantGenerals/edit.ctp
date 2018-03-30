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


<div class="applicantGenerals form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantGeneral) ?>
       <fieldset>
        <legend><?= __('Add Applicant General') ?></legend>
        <?php
            echo $this->Form->input('fisrtname', ['label' => ['text' => __('First name')]]);
            echo $this->Form->input('lastname', ['label' => ['text' => __('Last name')]]);
            echo $this->Form->input('gender_id', ['options' => $genders, 'label' => ['text' => __('Gender')]]);
            echo $this->Form->input('birthdate', ['label' => ['text' => __('Birthdate')],'dateFormat' => 'DMY', 'minYear' => 1940, 'maxYear' => 2010]);
          
            echo $this->Form->input('country_id', ['options' => $countries, 'label' => ['text' => __('What country do you currently live in ?')],'id' => 'countryid']); 
           
            echo $this->Form->input('city', ['label' => ['text' => __('What city do you currently live in ?')]]);  
            echo $this->Form->input('postcode', ['label' => ['text' => __('Please insert the Postcode')]]);       


            echo $this->Form->input('is_expat', ['options' => ['1' => __('Yes'),'0' => __('No')], 'label' => ['text' => __('Are you an expat in this currently country ?')]]);

            echo $this->Form->input('nationality_id', ['options' => $countries, 'label' => ['text' => __('Nationality')]]); 



            echo $this->Form->input('whatsapp_number', ['label' => ['text' => __('WhatsApp enabled mobile phone number')]]);

            echo $this->Form->input('phone', ['label' => ['text' => __('Other Phone mobile Number')]]);       


        ?>




    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
