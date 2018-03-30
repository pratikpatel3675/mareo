<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Type'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Item Type Subs'), ['controller' => 'ItemTypeSubs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Item Type Sub'), ['controller' => 'ItemTypeSubs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemTypes index large-9 medium-8 columns content">
    <h3><?= __('Item Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemTypes as $itemType): ?>
            <tr>
                <td><?= $this->Number->format($itemType->id) ?></td>
                <td><?= h($itemType->name) ?></td>
                <td><?= h($itemType->created) ?></td>
                <td><?= h($itemType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemType->id)]) ?>
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
