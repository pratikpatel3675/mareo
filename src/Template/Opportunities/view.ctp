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
        <li><?= $this->Html->link(__('List Donation Campaign Providers'), ['controller' => 'DonationCampaignProviders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Donation Campaign Provider'), ['controller' => 'DonationCampaignProviders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Scopes'), ['controller' => 'OpportunityScopes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Scope'), ['controller' => 'OpportunityScopes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Providers'), ['controller' => 'Providers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Provider'), ['controller' => 'Providers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Donation Campaigns'), ['controller' => 'DonationCampaigns', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Donation Campaign'), ['controller' => 'DonationCampaigns', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Opportunity Applications'), ['controller' => 'OpportunityApplications', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Opportunity Application'), ['controller' => 'OpportunityApplications', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Nationalities'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Nationality'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
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
            <td><?= $opportunity->has('education_desired_type') ? $this->Html->link($opportunity->education_desired_type->name_en, ['controller' => 'EducationDesiredTypes', 'action' => 'view', $opportunity->education_desired_type->id]) : '' ?></td>
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
        <h4><?= __('Related Opportunity Applications') ?></h4>
        <?php if (!empty($opportunity->opportunity_applications)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Applicant User Id') ?></th>
                <th><?= __('Opportunity Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Opportunitity Application Status Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($opportunity->opportunity_applications as $opportunityApplications): ?>
            <tr>
                <td><?= h($opportunityApplications->id) ?></td>
                <td><?= h($opportunityApplications->applicant_user_id) ?></td>
                <td><?= h($opportunityApplications->opportunity_id) ?></td>
                <td><?= h($opportunityApplications->country_id) ?></td>
                <td><?= h($opportunityApplications->opportunitity_application_status_id) ?></td>
                <td><?= h($opportunityApplications->created) ?></td>
                <td><?= h($opportunityApplications->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OpportunityApplications', 'action' => 'view', $opportunityApplications->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'OpportunityApplications', 'action' => 'edit', $opportunityApplications->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'OpportunityApplications', 'action' => 'delete', $opportunityApplications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $opportunityApplications->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Countries') ?></h4>
        <?php if (!empty($opportunity->nationalities)): ?>
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
            <?php foreach ($opportunity->nationalities as $nationalities): ?>
            <tr>
                <td><?= h($nationalities->id) ?></td>
                <td><?= h($nationalities->code) ?></td>
                <td><?= h($nationalities->name_en) ?></td>
                <td><?= h($nationalities->name_ara) ?></td>
                <td><?= h($nationalities->latitude) ?></td>
                <td><?= h($nationalities->longitude) ?></td>
                <td><?= h($nationalities->title1_en) ?></td>
                <td><?= h($nationalities->title1_ara) ?></td>
                <td><?= h($nationalities->text1_en) ?></td>
                <td><?= h($nationalities->text1_ara) ?></td>
                <td><?= h($nationalities->title2_en) ?></td>
                <td><?= h($nationalities->title2_ara) ?></td>
                <td><?= h($nationalities->text2_en) ?></td>
                <td><?= h($nationalities->text2_ara) ?></td>
                <td><?= h($nationalities->title3_en) ?></td>
                <td><?= h($nationalities->title3_ara) ?></td>
                <td><?= h($nationalities->text3_en) ?></td>
                <td><?= h($nationalities->text3_ara) ?></td>
                <td><?= h($nationalities->has_homepage) ?></td>
                <td><?= h($nationalities->flag_file_name) ?></td>
                <td><?= h($nationalities->created) ?></td>
                <td><?= h($nationalities->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Countries', 'action' => 'view', $nationalities->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Countries', 'action' => 'edit', $nationalities->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Countries', 'action' => 'delete', $nationalities->id], ['confirm' => __('Are you sure you want to delete # {0}?', $nationalities->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Countries') ?></h4>
        <?php if (!empty($opportunity->applied_countries)): ?>
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
            <?php foreach ($opportunity->applied_countries as $appliedCountries): ?>
            <tr>
                <td><?= h($appliedCountries->id) ?></td>
                <td><?= h($appliedCountries->code) ?></td>
                <td><?= h($appliedCountries->name_en) ?></td>
                <td><?= h($appliedCountries->name_ara) ?></td>
                <td><?= h($appliedCountries->latitude) ?></td>
                <td><?= h($appliedCountries->longitude) ?></td>
                <td><?= h($appliedCountries->title1_en) ?></td>
                <td><?= h($appliedCountries->title1_ara) ?></td>
                <td><?= h($appliedCountries->text1_en) ?></td>
                <td><?= h($appliedCountries->text1_ara) ?></td>
                <td><?= h($appliedCountries->title2_en) ?></td>
                <td><?= h($appliedCountries->title2_ara) ?></td>
                <td><?= h($appliedCountries->text2_en) ?></td>
                <td><?= h($appliedCountries->text2_ara) ?></td>
                <td><?= h($appliedCountries->title3_en) ?></td>
                <td><?= h($appliedCountries->title3_ara) ?></td>
                <td><?= h($appliedCountries->text3_en) ?></td>
                <td><?= h($appliedCountries->text3_ara) ?></td>
                <td><?= h($appliedCountries->has_homepage) ?></td>
                <td><?= h($appliedCountries->flag_file_name) ?></td>
                <td><?= h($appliedCountries->created) ?></td>
                <td><?= h($appliedCountries->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Countries', 'action' => 'view', $appliedCountries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Countries', 'action' => 'edit', $appliedCountries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Countries', 'action' => 'delete', $appliedCountries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appliedCountries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Countries') ?></h4>
        <?php if (!empty($opportunity->countries)): ?>
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
            <?php foreach ($opportunity->countries as $countries): ?>
            <tr>
                <td><?= h($countries->id) ?></td>
                <td><?= h($countries->code) ?></td>
                <td><?= h($countries->name_en) ?></td>
                <td><?= h($countries->name_ara) ?></td>
                <td><?= h($countries->latitude) ?></td>
                <td><?= h($countries->longitude) ?></td>
                <td><?= h($countries->title1_en) ?></td>
                <td><?= h($countries->title1_ara) ?></td>
                <td><?= h($countries->text1_en) ?></td>
                <td><?= h($countries->text1_ara) ?></td>
                <td><?= h($countries->title2_en) ?></td>
                <td><?= h($countries->title2_ara) ?></td>
                <td><?= h($countries->text2_en) ?></td>
                <td><?= h($countries->text2_ara) ?></td>
                <td><?= h($countries->title3_en) ?></td>
                <td><?= h($countries->title3_ara) ?></td>
                <td><?= h($countries->text3_en) ?></td>
                <td><?= h($countries->text3_ara) ?></td>
                <td><?= h($countries->has_homepage) ?></td>
                <td><?= h($countries->flag_file_name) ?></td>
                <td><?= h($countries->created) ?></td>
                <td><?= h($countries->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Countries', 'action' => 'view', $countries->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Countries', 'action' => 'edit', $countries->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Countries', 'action' => 'delete', $countries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $countries->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
