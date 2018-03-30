<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Applicant Address'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantAddresses index large-9 medium-8 columns content">
    <h3><?= __('Applicant Addresses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('addr_line1') ?></th>
                <th><?= $this->Paginator->sort('addr_line2') ?></th>
                <th><?= $this->Paginator->sort('addr_line3') ?></th>
                <th><?= $this->Paginator->sort('city') ?></th>
                <th><?= $this->Paginator->sort('state') ?></th>
                <th><?= $this->Paginator->sort('country_id') ?></th>
                <th><?= $this->Paginator->sort('postcode') ?></th>
                <th><?= $this->Paginator->sort('phone_landline') ?></th>
                <th><?= $this->Paginator->sort('phone_mobile') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicantAddresses as $applicantAddress): ?>
            <tr>
                <td><?= $this->Number->format($applicantAddress->id) ?></td>
                <td><?= $applicantAddress->has('user') ? $this->Html->link($applicantAddress->user->username, ['controller' => 'Users', 'action' => 'view', $applicantAddress->user->id]) : '' ?></td>
                <td><?= h($applicantAddress->addr_line1) ?></td>
                <td><?= h($applicantAddress->addr_line2) ?></td>
                <td><?= h($applicantAddress->addr_line3) ?></td>
                <td><?= h($applicantAddress->city) ?></td>
                <td><?= h($applicantAddress->state) ?></td>
                <td><?= $applicantAddress->has('country') ? $this->Html->link($applicantAddress->country->name_en, ['controller' => 'Countries', 'action' => 'view', $applicantAddress->country->id]) : '' ?></td>
                <td><?= h($applicantAddress->postcode) ?></td>
                <td><?= h($applicantAddress->phone_landline) ?></td>
                <td><?= h($applicantAddress->phone_mobile) ?></td>
                <td><?= h($applicantAddress->email) ?></td>
                <td><?= h($applicantAddress->created) ?></td>
                <td><?= h($applicantAddress->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicantAddress->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicantAddress->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicantAddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantAddress->id)]) ?>
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
