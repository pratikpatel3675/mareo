<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Found Item'), ['action' => 'edit', $foundItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Found Item'), ['action' => 'delete', $foundItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foundItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Found Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Found Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Types'), ['controller' => 'ItemTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Type'), ['controller' => 'ItemTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="foundItems view large-9 medium-8 columns content">
    <h3><?= h($foundItem->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($foundItem->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($foundItem->description) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $foundItem->has('user') ? $this->Html->link($foundItem->user->username, ['controller' => 'Users', 'action' => 'view', $foundItem->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $foundItem->has('country') ? $this->Html->link($foundItem->country->name_en, ['controller' => 'Countries', 'action' => 'view', $foundItem->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Item Type') ?></th>
            <td><?= $foundItem->has('item_type') ? $this->Html->link($foundItem->item_type->name, ['controller' => 'ItemTypes', 'action' => 'view', $foundItem->item_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($foundItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($foundItem->is_active) ?></td>
        </tr>
        <tr>
            <th><?= __('Last Status') ?></th>
            <td><?= $this->Number->format($foundItem->last_status) ?></td>
        </tr>
        <tr>
            <th><?= __('Found Date') ?></th>
            <td><?= h($foundItem->found_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($foundItem->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($foundItem->modified) ?></td>
        </tr>
    </table>
</div>
