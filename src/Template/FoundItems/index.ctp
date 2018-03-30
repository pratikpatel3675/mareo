<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Found Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Types'), ['controller' => 'ItemTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Type'), ['controller' => 'ItemTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="foundItems index large-9 medium-8 columns content">
    <h3><?= __('Found Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('description') ?></th>
                <th><?= $this->Paginator->sort('found_date') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('is_active') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('item_type_id') ?></th>
                <th><?= $this->Paginator->sort('last_status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($foundItems as $foundItem): ?>
            <tr>
                <td><?= $this->Number->format($foundItem->id) ?></td>
                <td><?= h($foundItem->name) ?></td>
                <td><?= h($foundItem->description) ?></td>
                <td><?= h($foundItem->found_date) ?></td>
                <td><?= h($foundItem->created) ?></td>
                <td><?= h($foundItem->modified) ?></td>
                <td><?= $this->Number->format($foundItem->is_active) ?></td>
                <td><?= $foundItem->has('user') ? $this->Html->link($foundItem->user->username, ['controller' => 'Users', 'action' => 'view', $foundItem->user->id]) : '' ?></td>
                <td><?= $foundItem->has('country') ? $this->Html->link($foundItem->country->name_en, ['controller' => 'Countries', 'action' => 'view', $foundItem->country->id]) : '' ?></td>
                <td><?= $foundItem->has('item_type') ? $this->Html->link($foundItem->item_type->name, ['controller' => 'ItemTypes', 'action' => 'view', $foundItem->item_type->id]) : '' ?></td>
                <td><?= $this->Number->format($foundItem->last_status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $foundItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $foundItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $foundItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foundItem->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
