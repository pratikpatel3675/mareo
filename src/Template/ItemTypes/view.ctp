<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Type'), ['action' => 'edit', $itemType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Type'), ['action' => 'delete', $itemType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Item Type Subs'), ['controller' => 'ItemTypeSubs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Type Sub'), ['controller' => 'ItemTypeSubs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemTypes view large-9 medium-8 columns content">
    <h3><?= h($itemType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($itemType->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemType->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($itemType->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($itemType->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Item Type Subs') ?></h4>
        <?php if (!empty($itemType->item_type_subs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Item Type Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemType->item_type_subs as $itemTypeSubs): ?>
            <tr>
                <td><?= h($itemTypeSubs->id) ?></td>
                <td><?= h($itemTypeSubs->name) ?></td>
                <td><?= h($itemTypeSubs->item_type_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ItemTypeSubs', 'action' => 'view', $itemTypeSubs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ItemTypeSubs', 'action' => 'edit', $itemTypeSubs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ItemTypeSubs', 'action' => 'delete', $itemTypeSubs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemTypeSubs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Lost Items') ?></h4>
        <?php if (!empty($itemType->lost_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Description') ?></th>
                <th><?= __('Lost Date') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Item Type Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($itemType->lost_items as $lostItems): ?>
            <tr>
                <td><?= h($lostItems->id) ?></td>
                <td><?= h($lostItems->name) ?></td>
                <td><?= h($lostItems->description) ?></td>
                <td><?= h($lostItems->lost_date) ?></td>
                <td><?= h($lostItems->created) ?></td>
                <td><?= h($lostItems->modified) ?></td>
                <td><?= h($lostItems->is_active) ?></td>
                <td><?= h($lostItems->user_id) ?></td>
                <td><?= h($lostItems->country_id) ?></td>
                <td><?= h($lostItems->item_type_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LostItems', 'action' => 'view', $lostItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LostItems', 'action' => 'edit', $lostItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LostItems', 'action' => 'delete', $lostItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lostItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
