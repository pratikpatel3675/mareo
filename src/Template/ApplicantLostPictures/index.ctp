<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Lost Picture'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantLostPictures index large-9 medium-8 columns content">
    <h3><?= __('Applicant Lost Pictures') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('lost_item_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('picture') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantLostPictures as $applicantLostPicture): ?>
            <tr>
                <td><?= $this->Number->format($applicantLostPicture->id) ?></td>
                <td><?= $applicantLostPicture->has('lost_item') ? $this->Html->link($applicantLostPicture->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $applicantLostPicture->lost_item->id]) : '' ?></td>
                <td><?= h($applicantLostPicture->created) ?></td>
                <td><?= h($applicantLostPicture->modified) ?></td>
                <td><?= h($applicantLostPicture->picture) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantLostPicture->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantLostPicture->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantLostPicture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantLostPicture->id)]) ?>
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
