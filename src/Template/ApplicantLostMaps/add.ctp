<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Applicant Lost Maps'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantLostMaps form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantLostMap) ?>
    <fieldset>
        <legend><?= __('Add Applicant Lost Map') ?></legend>
        <?php
            echo $this->Form->input('lost_item_id', ['options' => $lostItems]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('map_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
