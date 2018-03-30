<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $foundItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $foundItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Found Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Types'), ['controller' => 'ItemTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Type'), ['controller' => 'ItemTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="foundItems form large-9 medium-8 columns content">
    <?= $this->Form->create($foundItem) ?>
    <fieldset>
        <legend><?= __('Edit Found Item') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('found_date', ['empty' => true]);
            echo $this->Form->input('is_active');
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('item_type_id', ['options' => $itemTypes]);
            echo $this->Form->input('last_status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
