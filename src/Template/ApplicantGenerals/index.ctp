<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="nav nav-tabs">
        <li><?= $this->Html->link(__('New Applicant General'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantGenerals index large-9 medium-8 columns content">
    <h3><?= __('Applicant Generals') ?></h3>
    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('unhcr_id') ?></th>
                <th><?= $this->Paginator->sort('unrwa_id') ?></th>
                <th><?= $this->Paginator->sort('fisrtname') ?></th>
                <th><?= $this->Paginator->sort('lastname') ?></th>
                <th><?= $this->Paginator->sort('fathername') ?></th>
                <th><?= $this->Paginator->sort('gender_id') ?></th>
                <th><?= $this->Paginator->sort('birthdate') ?></th>
                <th><?= $this->Paginator->sort('nationality_id') ?></th>
                <th><?= $this->Paginator->sort('marital_status') ?></th>
                <th><?= $this->Paginator->sort('dependants_count') ?></th>
                <th><?= $this->Paginator->sort('has_disability') ?></th>
                <th><?= $this->Paginator->sort('disability_description') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantGenerals as $applicantGeneral): ?>
            <tr>
                <td><?= $this->Number->format($applicantGeneral->id) ?></td>
                <td><?= $applicantGeneral->has('user') ? $this->Html->link($applicantGeneral->user->username, ['controller' => 'Users', 'action' => 'view', $applicantGeneral->user->id]) : '' ?></td>
                <td><?= h($applicantGeneral->unhcr_id) ?></td>
                <td><?= h($applicantGeneral->unrwa_id) ?></td>
                <td><?= h($applicantGeneral->fisrtname) ?></td>
                <td><?= h($applicantGeneral->lastname) ?></td>
                <td><?= h($applicantGeneral->fathername) ?></td>
                <td><?= $this->Number->format($applicantGeneral->gender_id) ?></td>
                <td><?= h($applicantGeneral->birthdate) ?></td>
                <td><?= $applicantGeneral->has('country') ? $this->Html->link($applicantGeneral->country->name_en, ['controller' => 'Countries', 'action' => 'view', $applicantGeneral->country->id]) : '' ?></td>
                <td><?= $this->Number->format($applicantGeneral->marital_status) ?></td>
                <td><?= $this->Number->format($applicantGeneral->dependants_count) ?></td>
                <td><?= $this->Number->format($applicantGeneral->has_disability) ?></td>
                <td><?= h($applicantGeneral->disability_description) ?></td>
                <td><?= h($applicantGeneral->created) ?></td>
                <td><?= h($applicantGeneral->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantGeneral->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantGeneral->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantGeneral->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantGeneral->id)]) ?>
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
