<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant Lost Map'), ['action' => 'edit', $applicantLostMap->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant Lost Map'), ['action' => 'delete', $applicantLostMap->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantLostMap->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Lost Maps'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Lost Map'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantLostMaps view large-9 medium-8 columns content">
    <h3><?= h($applicantLostMap->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Lost Item') ?></th>
            <td><?= $applicantLostMap->has('lost_item') ? $this->Html->link($applicantLostMap->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $applicantLostMap->lost_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Country') ?></th>
            <td><?= $applicantLostMap->has('country') ? $this->Html->link($applicantLostMap->country->name_en, ['controller' => 'Countries', 'action' => 'view', $applicantLostMap->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Map Id') ?></th>
            <td><?= h($applicantLostMap->map_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantLostMap->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($applicantLostMap->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($applicantLostMap->modified) ?></td>
        </tr>
    </table>
</div>
