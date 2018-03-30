<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant Lost Picture'), ['action' => 'edit', $applicantLostPicture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant Lost Picture'), ['action' => 'delete', $applicantLostPicture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantLostPicture->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Lost Pictures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Lost Picture'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantLostPictures view large-9 medium-8 columns content">
    <h3><?= h($applicantLostPicture->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Lost Item') ?></th>
            <td><?= $applicantLostPicture->has('lost_item') ? $this->Html->link($applicantLostPicture->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $applicantLostPicture->lost_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Picture') ?></th>
            <td><?= h($applicantLostPicture->picture) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantLostPicture->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($applicantLostPicture->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($applicantLostPicture->modified) ?></td>
        </tr>
    </table>
</div>
