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

echo $this->Html->script('userProfileGeneral', ['block' => 'scriptBottom']);
?>


<div class="foundItems form large-9 medium-8 columns content">
    <?= $this->Form->create($foundItem) ?>
    <fieldset>
        <legend><?= __('Add Found Item') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description', ['type'=>'textArea','rows'=>'10', 'Description','label'=>__('Short Description')]); 
            echo $this->Form->input('found_date', ['empty' => true]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('item_type_id', ['options' => $itemTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
