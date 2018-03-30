<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Opportunity'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Durations'), ['controller' => 'OpportunityDurations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Duration'), ['controller' => 'OpportunityDurations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Education Desired Types'), ['controller' => 'EducationDesiredTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Education Desired Type'), ['controller' => 'EducationDesiredTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Donors'), ['controller' => 'Donors', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Donor'), ['controller' => 'Donors', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Providers'), ['controller' => 'Providers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provider'), ['controller' => 'Providers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Donation Campaigns'), ['controller' => 'DonationCampaigns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Donation Campaign'), ['controller' => 'DonationCampaigns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Scopes'), ['controller' => 'OpportunityScopes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Scope'), ['controller' => 'OpportunityScopes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Donation Campaign Providers'), ['controller' => 'DonationCampaignProviders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Donation Campaign Provider'), ['controller' => 'DonationCampaignProviders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Applicant Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Applicant User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Target Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Target Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Provider Offices'), ['controller' => 'ProviderOffices', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Provider Office'), ['controller' => 'ProviderOffices', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="opportunities index large-9 medium-8 columns content">
    <h3><?= __('Opportunities') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name_en') ?></th>
                <th><?= $this->Paginator->sort('name_ara') ?></th>
                <th><?= $this->Paginator->sort('description_en') ?></th>
                <th><?= $this->Paginator->sort('description_ara') ?></th>
                <th><?= $this->Paginator->sort('opportunity_duration_id') ?></th>
                <th><?= $this->Paginator->sort('education_desired_type_id') ?></th>
                <th><?= $this->Paginator->sort('donor_id') ?></th>
                <th><?= $this->Paginator->sort('provider_id') ?></th>
                <th><?= $this->Paginator->sort('donation_campaign_id') ?></th>
                <th><?= $this->Paginator->sort('donation_campaign_provider_id') ?></th>
                <th><?= $this->Paginator->sort('opportunity_scope_id') ?></th>
                <th><?= $this->Paginator->sort('application_end_date') ?></th>
                <th><?= $this->Paginator->sort('budget') ?></th>
                <th><?= $this->Paginator->sort('currency_id') ?></th>
                <th><?= $this->Paginator->sort('seats') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($opportunities as $opportunity): ?>
            <tr>
                <td><?= $this->Number->format($opportunity->id) ?></td>
                <td><?= h($opportunity->name_en) ?></td>
                <td><?= h($opportunity->name_ara) ?></td>
                <td><?= h($opportunity->description_en) ?></td>
                <td><?= h($opportunity->description_ara) ?></td>
                <td><?= $opportunity->has('opportunity_duration') ? $this->Html->link($opportunity->opportunity_duration->id, ['controller' => 'OpportunityDurations', 'action' => 'view', $opportunity->opportunity_duration->id]) : '' ?></td>
                <td><?= $opportunity->has('education_desired_type') ? $this->Html->link($opportunity->education_desired_type->id, ['controller' => 'EducationDesiredTypes', 'action' => 'view', $opportunity->education_desired_type->id]) : '' ?></td>
                <td><?= $opportunity->has('donor') ? $this->Html->link($opportunity->donor->name, ['controller' => 'Donors', 'action' => 'view', $opportunity->donor->id]) : '' ?></td>
                <td><?= $opportunity->has('provider') ? $this->Html->link($opportunity->provider->name, ['controller' => 'Providers', 'action' => 'view', $opportunity->provider->id]) : '' ?></td>
                <td><?= $opportunity->has('donation_campaign') ? $this->Html->link($opportunity->donation_campaign->name, ['controller' => 'DonationCampaigns', 'action' => 'view', $opportunity->donation_campaign->id]) : '' ?></td>
                <td><?= $opportunity->has('donation_campaign_provider') ? $this->Html->link($opportunity->donation_campaign_provider->id, ['controller' => 'DonationCampaignProviders', 'action' => 'view', $opportunity->donation_campaign_provider->id]) : '' ?></td>
                <td><?= $opportunity->has('opportunity_scope') ? $this->Html->link($opportunity->opportunity_scope->name_en, ['controller' => 'OpportunityScopes', 'action' => 'view', $opportunity->opportunity_scope->id]) : '' ?></td>
                <td><?= h($opportunity->application_end_date) ?></td>
                <td><?= $this->Number->format($opportunity->budget) ?></td>
                <td><?= $opportunity->has('currency') ? $this->Html->link($opportunity->currency->name, ['controller' => 'Currencies', 'action' => 'view', $opportunity->currency->id]) : '' ?></td>
                <td><?= $this->Number->format($opportunity->seats) ?></td>
                <td><?= h($opportunity->created) ?></td>
                <td><?= h($opportunity->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $opportunity->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $opportunity->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $opportunity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunity->id)]) ?>
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
