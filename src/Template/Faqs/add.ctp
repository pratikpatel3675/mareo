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

//debug($countries);

?>

<div class="applicantTravelDocuments form large-9 medium-8 columns content">
    <?= $this->Form->create($faq) ?>
    <fieldset>
        <legend><?= __('Ask Any Question and Get your Answer!') ?></legend>
             <div class='row'>

        <?php
           
        $session = $this->request->session();
        $lang = $session->read('System.language.code');
     
        if ($lang == 'en_US'){
            echo $this->Form->input('question_en', ['label' => ['text' => __('Ask your Question')]]);
}
else
{
            echo $this->Form->input('question_ara', ['label' => ['text' => __('Ask your Question')]]);
         
}
          // echo $this->Form->input('country_id', ['options' => ['333' => __('NA'), '2314' => __('Jordan'), '2384' => __('Lebanon')], 'label' => ['text' => __('Country')]]);
         echo $this->Form->input('country_id', ['options' => $countries]);

        ?></div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>