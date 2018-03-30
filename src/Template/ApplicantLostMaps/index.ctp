<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Lost Map'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantLostMaps index large-9 medium-8 columns content">
    <h3><?= __('Applicant Lost Maps') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('lost_item_id') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('map_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantLostMaps as $applicantLostMap): ?>
            <tr>
                <td><?= $this->Number->format($applicantLostMap->id) ?></td>
                <td><?= $applicantLostMap->has('lost_item') ? $this->Html->link($applicantLostMap->lost_item->name, ['controller' => 'LostItems', 'action' => 'view', $applicantLostMap->lost_item->id]) : '' ?></td>
                <td><?= $applicantLostMap->has('country') ? $this->Html->link($applicantLostMap->country->name_en, ['controller' => 'Countries', 'action' => 'view', $applicantLostMap->country->id]) : '' ?></td>
                <td><?= h($applicantLostMap->created) ?></td>
                <td><?= h($applicantLostMap->modified) ?></td>
                <td><?= h($applicantLostMap->map_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantLostMap->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantLostMap->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantLostMap->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantLostMap->id)]) ?>
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
