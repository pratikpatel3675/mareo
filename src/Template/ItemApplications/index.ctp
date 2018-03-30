<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Application'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemApplications index large-9 medium-8 columns content">
    <h3><?= __('Item Applications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('lost_item_id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemApplications as $itemApplication): ?>
            <tr>
                <td><?= $this->Number->format($itemApplication->id) ?></td>
                <td><?= $itemApplication->has('user') ? $this->Html->link($itemApplication->user->username, ['controller' => 'Users', 'action' => 'view', $itemApplication->user->id]) : '' ?></td>
                <td><?= $itemApplication->has('lost_item') ? $this->Html->link($itemApplication->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $itemApplication->lost_item->id]) : '' ?></td>
                <td><?= $itemApplication->has('country') ? $this->Html->link($itemApplication->country->name_en, ['controller' => 'Countries', 'action' => 'view', $itemApplication->country->id]) : '' ?></td>
                <td><?= $this->Number->format($itemApplication->status) ?></td>
                <td><?= h($itemApplication->created) ?></td>
                <td><?= h($itemApplication->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemApplication->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemApplication->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemApplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemApplication->id)]) ?>
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
