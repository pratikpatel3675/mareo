<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Applicant Found Picture'), ['action' => 'edit', $applicantFoundPicture->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Applicant Found Picture'), ['action' => 'delete', $applicantFoundPicture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantFoundPicture->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Applicant Found Pictures'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Applicant Found Picture'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Found Items'), ['controller' => 'FoundItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Found Item'), ['controller' => 'FoundItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicantFoundPictures view large-9 medium-8 columns content">
    <h3><?= h($applicantFoundPicture->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Found Item') ?></th>
            <td><?= $applicantFoundPicture->has('found_item') ? $this->Html->link($applicantFoundPicture->found_item->name, ['controller' => 'FoundItems', 'action' => 'view', $applicantFoundPicture->found_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($applicantFoundPicture->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Path') ?></th>
            <td><?= h($applicantFoundPicture->path) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($applicantFoundPicture->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($applicantFoundPicture->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($applicantFoundPicture->modified) ?></td>
        </tr>
    </table>
</div>
