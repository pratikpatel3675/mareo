<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Item Founded Application'), ['action' => 'edit', $itemFoundedApplication->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Item Founded Application'), ['action' => 'delete', $itemFoundedApplication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $itemFoundedApplication->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Item Founded Applications'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Item Founded Application'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Found Items'), ['controller' => 'FoundItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Found Item'), ['controller' => 'FoundItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="itemFoundedApplications view large-9 medium-8 columns content">
    <h3><?= h($itemFoundedApplication->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $itemFoundedApplication->has('user') ? $this->Html->link($itemFoundedApplication->user->username, ['controller' => 'Users', 'action' => 'view', $itemFoundedApplication->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Found Item') ?></th>
            <td><?= $itemFoundedApplication->has('found_item') ? $this->Html->link($itemFoundedApplication->found_item->name, ['controller' => 'FoundItems', 'action' => 'view', $itemFoundedApplication->found_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $itemFoundedApplication->has('country') ? $this->Html->link($itemFoundedApplication->country->name_en, ['controller' => 'Countries', 'action' => 'view', $itemFoundedApplication->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($itemFoundedApplication->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $this->Number->format($itemFoundedApplication->status) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($itemFoundedApplication->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($itemFoundedApplication->modified) ?></td>
        </tr>
    </table>
</div>
