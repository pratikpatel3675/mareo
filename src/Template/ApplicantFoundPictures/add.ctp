<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Applicant Found Pictures'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Found Items'), ['controller' => 'FoundItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Found Item'), ['controller' => 'FoundItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantFoundPictures form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantFoundPicture) ?>
    <fieldset>
        <legend><?= __('Add Applicant Found Picture') ?></legend>
        <?php
            echo $this->Form->input('found_item_id', ['options' => $foundItems]);
            echo $this->Form->input('name');
            echo $this->Form->input('path');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
