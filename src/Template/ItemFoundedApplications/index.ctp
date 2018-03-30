<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Item Founded Application'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Found Items'), ['controller' => 'FoundItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Found Item'), ['controller' => 'FoundItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="itemFoundedApplications index large-9 medium-8 columns content">
    <h3><?= __('Item Founded Applications') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('found_item_id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemFoundedApplications as $itemFoundedApplication): ?>
            <tr>
                <td><?= $this->Number->format($itemFoundedApplication->id) ?></td>
                <td><?= $itemFoundedApplication->has('user') ? $this->Html->link($itemFoundedApplication->user->username, ['controller' => 'Users', 'action' => 'view', $itemFoundedApplication->user->id]) : '' ?></td>
                <td><?= $itemFoundedApplication->has('found_item') ? $this->Html->link($itemFoundedApplication->found_item->name, ['controller' => 'FoundItems', 'action' => 'view', $itemFoundedApplication->found_item->id]) : '' ?></td>
                <td><?= $itemFoundedApplication->has('country') ? $this->Html->link($itemFoundedApplication->country->name_en, ['controller' => 'Countries', 'action' => 'view', $itemFoundedApplication->country->id]) : '' ?></td>
                <td><?= $this->Number->format($itemFoundedApplication->status) ?></td>
                <td><?= h($itemFoundedApplication->created) ?></td>
                <td><?= h($itemFoundedApplication->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $itemFoundedApplication->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $itemFoundedApplication->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $itemFoundedApplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemFoundedApplication->id)]) ?>
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
