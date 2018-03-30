<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Opportunities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Durations'), ['controller' => 'OpportunityDurations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Duration'), ['controller' => 'OpportunityDurations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Education Desired Types'), ['controller' => 'EducationDesiredTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Education Desired Type'), ['controller' => 'EducationDesiredTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Donation Campaign Providers'), ['controller' => 'DonationCampaignProviders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Donation Campaign Provider'), ['controller' => 'DonationCampaignProviders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Scopes'), ['controller' => 'OpportunityScopes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Scope'), ['controller' => 'OpportunityScopes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Currencies'), ['controller' => 'Currencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Currency'), ['controller' => 'Currencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Providers'), ['controller' => 'Providers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Provider'), ['controller' => 'Providers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Donation Campaigns'), ['controller' => 'DonationCampaigns', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Donation Campaign'), ['controller' => 'DonationCampaigns', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Opportunity Applications'), ['controller' => 'OpportunityApplications', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Opportunity Application'), ['controller' => 'OpportunityApplications', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Nationalities'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Nationality'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="opportunities form large-9 medium-8 columns content">
    <?= $this->Form->create($opportunity) ?>
    <fieldset>
        <legend><?= __('Add Opportunity') ?></legend>
        <?php
            echo $this->Form->input('name_en');
            echo $this->Form->input('name_ara');
            echo $this->Form->input('description_en');
            echo $this->Form->input('description_ara');
            echo $this->Form->input('opportunity_duration_id', ['options' => $opportunityDurations]);
            echo $this->Form->input('education_desired_type_id', ['options' => $educationDesiredTypes]);
            echo $this->Form->input('donation_campaign_provider_id', ['options' => $donationCampaignProviders]);
            echo $this->Form->input('opportunity_scope_id', ['options' => $opportunityScopes]);
            echo $this->Form->input('application_end_date', ['empty' => true]);
            echo $this->Form->input('budget');
            echo $this->Form->input('currency_id', ['options' => $currencies, 'empty' => true]);
            echo $this->Form->input('seats');
            echo $this->Form->input('nationalities._ids', ['options' => $nationalities]);
            echo $this->Form->input('applied_countries._ids', ['options' => $appliedCountries]);
            echo $this->Form->input('countries._ids', ['options' => $countries]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
