<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Opportunity'), ['action' => 'edit', $opportunity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Opportunity'), ['action' => 'delete', $opportunity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Opportunities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Durations'), ['controller' => 'OpportunityDurations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Duration'), ['controller' => 'OpportunityDurations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Education Desired Types'), ['controller' => 'EducationDesiredTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Education Desired Type'), ['controller' => 'EducationDesiredTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Donors'), ['controller' => 'Donors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Donor'), ['controller' => 'Donors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Providers'), ['controller' => 'Providers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Provider'), ['controller' => 'Providers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Donation Campaigns'), ['controller' => 'DonationCampaigns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Donation Campaign'), ['controller' => 'DonationCampaigns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Scopes'), ['controller' => 'OpportunityScopes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Scope'), ['controller' => 'OpportunityScopes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Donation Campaign Providers'), ['controller' => 'DonationCampaignProviders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Donation Campaign Provider'), ['controller' => 'DonationCampaignProviders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Applicant Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Applicant User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Target Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Target Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Provider Offices'), ['controller' => 'ProviderOffices', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Provider Office'), ['controller' => 'ProviderOffices', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="opportunities view large-9 medium-8 columns content">
    <h3><?= h($opportunity->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name En') ?></th>
            <td><?= h($opportunity->name_en) ?></td>
        </tr>
        <tr>
            <th><?= __('Name Ara') ?></th>
            <td><?= h($opportunity->name_ara) ?></td>
        </tr>
        <tr>
            <th><?= __('Description En') ?></th>
            <td><?= h($opportunity->description_en) ?></td>
        </tr>
        <tr>
            <th><?= __('Description Ara') ?></th>
            <td><?= h($opportunity->description_ara) ?></td>
        </tr>
        <tr>
            <th><?= __('Opportunity Duration') ?></th>
            <td><?= $opportunity->has('opportunity_duration') ? $this->Html->link($opportunity->opportunity_duration->id, ['controller' => 'OpportunityDurations', 'action' => 'view', $opportunity->opportunity_duration->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Education Desired Type') ?></th>
            <td><?= $opportunity->has('education_desired_type') ? $this->Html->link($opportunity->education_desired_type->id, ['controller' => 'EducationDesiredTypes', 'action' => 'view', $opportunity->education_desired_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Donor') ?></th>
            <td><?= $opportunity->has('donor') ? $this->Html->link($opportunity->donor->name, ['controller' => 'Donors', 'action' => 'view', $opportunity->donor->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Provider') ?></th>
            <td><?= $opportunity->has('provider') ? $this->Html->link($opportunity->provider->name, ['controller' => 'Providers', 'action' => 'view', $opportunity->provider->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Donation Campaign') ?></th>
            <td><?= $opportunity->has('donation_campaign') ? $this->Html->link($opportunity->donation_campaign->name, ['controller' => 'DonationCampaigns', 'action' => 'view', $opportunity->donation_campaign->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Donation Campaign Provider') ?></th>
            <td><?= $opportunity->has('donation_campaign_provider') ? $this->Html->link($opportunity->donation_campaign_provider->id, ['controller' => 'DonationCampaignProviders', 'action' => 'view', $opportunity->donation_campaign_provider->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Opportunity Scope') ?></th>
            <td><?= $opportunity->has('opportunity_scope') ? $this->Html->link($opportunity->opportunity_scope->name_en, ['controller' => 'OpportunityScopes', 'action' => 'view', $opportunity->opportunity_scope->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Currency') ?></th>
            <td><?= $opportunity->has('currency') ? $this->Html->link($opportunity->currency->name, ['controller' => 'Currencies', 'action' => 'view', $opportunity->currency->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($opportunity->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Budget') ?></th>
            <td><?= $this->Number->format($opportunity->budget) ?></td>
        </tr>
        <tr>
            <th><?= __('Seats') ?></th>
            <td><?= $this->Number->format($opportunity->seats) ?></td>
        </tr>
        <tr>
            <th><?= __('Application End Date') ?></th>
            <td><?= h($opportunity->application_end_date) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($opportunity->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($opportunity->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($opportunity->opportunity_applicant_users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Username') ?></th>
                <th><?= __('Password') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Phone') ?></th>
                <th><?= __('Role') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($opportunity->opportunity_applicant_users as $opportunityApplicantUsers): ?>
            <tr>
                <td><?= h($opportunityApplicantUsers->id) ?></td>
                <td><?= h($opportunityApplicantUsers->username) ?></td>
                <td><?= h($opportunityApplicantUsers->password) ?></td>
                <td><?= h($opportunityApplicantUsers->country_id) ?></td>
                <td><?= h($opportunityApplicantUsers->email) ?></td>
                <td><?= h($opportunityApplicantUsers->phone) ?></td>
                <td><?= h($opportunityApplicantUsers->role) ?></td>
                <td><?= h($opportunityApplicantUsers->active) ?></td>
                <td><?= h($opportunityApplicantUsers->created) ?></td>
                <td><?= h($opportunityApplicantUsers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $opportunityApplicantUsers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $opportunityApplicantUsers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $opportunityApplicantUsers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunityApplicantUsers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Countries') ?></h4>
        <?php if (!empty($opportunity->opportunity_target_countries)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Code') ?></th>
                <th><?= __('Name En') ?></th>
                <th><?= __('Name Ara') ?></th>
                <th><?= __('Latitude') ?></th>
                <th><?= __('Longitude') ?></th>
                <th><?= __('Title1 En') ?></th>
                <th><?= __('Title1 Ara') ?></th>
                <th><?= __('Text1 En') ?></th>
                <th><?= __('Text1 Ara') ?></th>
                <th><?= __('Title2 En') ?></th>
                <th><?= __('Title2 Ara') ?></th>
                <th><?= __('Text2 En') ?></th>
                <th><?= __('Text2 Ara') ?></th>
                <th><?= __('Title3 En') ?></th>
                <th><?= __('Title3 Ara') ?></th>
                <th><?= __('Text3 En') ?></th>
                <th><?= __('Text3 Ara') ?></th>
                <th><?= __('Has Homepage') ?></th>
                <th><?= __('Flag File Name') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($opportunity->opportunity_target_countries as $opportunityTargetCountries): ?>
            <tr>
                <td><?= h($opportunityTargetCountries->id) ?></td>
                <td><?= h($opportunityTargetCountries->code) ?></td>
                <td><?= h($opportunityTargetCountries->name_en) ?></td>
                <td><?= h($opportunityTargetCountries->name_ara) ?></td>
                <td><?= h($opportunityTargetCountries->latitude) ?></td>
                <td><?= h($opportunityTargetCountries->longitude) ?></td>
                <td><?= h($opportunityTargetCountries->title1_en) ?></td>
                <td><?= h($opportunityTargetCountries->title1_ara) ?></td>
                <td><?= h($opportunityTargetCountries->text1_en) ?></td>
                <td><?= h($opportunityTargetCountries->text1_ara) ?></td>
                <td><?= h($opportunityTargetCountries->title2_en) ?></td>
                <td><?= h($opportunityTargetCountries->title2_ara) ?></td>
                <td><?= h($opportunityTargetCountries->text2_en) ?></td>
                <td><?= h($opportunityTargetCountries->text2_ara) ?></td>
                <td><?= h($opportunityTargetCountries->title3_en) ?></td>
                <td><?= h($opportunityTargetCountries->title3_ara) ?></td>
                <td><?= h($opportunityTargetCountries->text3_en) ?></td>
                <td><?= h($opportunityTargetCountries->text3_ara) ?></td>
                <td><?= h($opportunityTargetCountries->has_homepage) ?></td>
                <td><?= h($opportunityTargetCountries->flag_file_name) ?></td>
                <td><?= h($opportunityTargetCountries->created) ?></td>
                <td><?= h($opportunityTargetCountries->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Countries', 'action' => 'view', $opportunityTargetCountries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Countries', 'action' => 'edit', $opportunityTargetCountries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Countries', 'action' => 'delete', $opportunityTargetCountries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunityTargetCountries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Provider Offices') ?></h4>
        <?php if (!empty($opportunity->opportunity_provider_offices)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Provider Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Addr Line1') ?></th>
                <th><?= __('Addr Line2') ?></th>
                <th><?= __('Addr Line3') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('Postcode') ?></th>
                <th><?= __('Phone') ?></th>
                <th><?= __('Fax') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Is Active') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($opportunity->opportunity_provider_offices as $opportunityProviderOffices): ?>
            <tr>
                <td><?= h($opportunityProviderOffices->id) ?></td>
                <td><?= h($opportunityProviderOffices->provider_id) ?></td>
                <td><?= h($opportunityProviderOffices->country_id) ?></td>
                <td><?= h($opportunityProviderOffices->name) ?></td>
                <td><?= h($opportunityProviderOffices->addr_line1) ?></td>
                <td><?= h($opportunityProviderOffices->addr_line2) ?></td>
                <td><?= h($opportunityProviderOffices->addr_line3) ?></td>
                <td><?= h($opportunityProviderOffices->city) ?></td>
                <td><?= h($opportunityProviderOffices->postcode) ?></td>
                <td><?= h($opportunityProviderOffices->phone) ?></td>
                <td><?= h($opportunityProviderOffices->fax) ?></td>
                <td><?= h($opportunityProviderOffices->email) ?></td>
                <td><?= h($opportunityProviderOffices->is_active) ?></td>
                <td><?= h($opportunityProviderOffices->created) ?></td>
                <td><?= h($opportunityProviderOffices->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProviderOffices', 'action' => 'view', $opportunityProviderOffices->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProviderOffices', 'action' => 'edit', $opportunityProviderOffices->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProviderOffices', 'action' => 'delete', $opportunityProviderOffices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunityProviderOffices->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
