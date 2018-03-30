<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Application'), ['action' => 'edit', $itemApplication->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Application'), ['action' => 'delete', $itemApplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemApplication->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Applications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Application'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemApplications view large-9 medium-8 columns content">
    <h3><?= h($itemApplication->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $itemApplication->has('user') ? $this->Html->link($itemApplication->user->username, ['controller' => 'Users', 'action' => 'view', $itemApplication->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Lost Item') ?></th>
            <td><?= $itemApplication->has('lost_item') ? $this->Html->link($itemApplication->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $itemApplication->lost_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $itemApplication->has('country') ? $this->Html->link($itemApplication->country->name_en, ['controller' => 'Countries', 'action' => 'view', $itemApplication->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemApplication->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($itemApplication->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($itemApplication->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($itemApplication->modified) ?></td>
        </tr>
    </table>
</div>
