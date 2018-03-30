<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Found Picture'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Found Items'), ['controller' => 'FoundItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Found Item'), ['controller' => 'FoundItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantFoundPictures index large-9 medium-8 columns content">
    <h3><?= __('Applicant Found Pictures') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('found_item_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('path') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantFoundPictures as $applicantFoundPicture): ?>
            <tr>
                <td><?= $this->Number->format($applicantFoundPicture->id) ?></td>
                <td><?= $applicantFoundPicture->has('found_item') ? $this->Html->link($applicantFoundPicture->found_item->name, ['controller' => 'FoundItems', 'action' => 'view', $applicantFoundPicture->found_item->id]) : '' ?></td>
                <td><?= h($applicantFoundPicture->created) ?></td>
                <td><?= h($applicantFoundPicture->modified) ?></td>
                <td><?= h($applicantFoundPicture->name) ?></td>
                <td><?= h($applicantFoundPicture->path) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantFoundPicture->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantFoundPicture->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantFoundPicture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantFoundPicture->id)]) ?>
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
