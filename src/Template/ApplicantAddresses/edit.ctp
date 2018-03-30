<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantAddress->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantAddress->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicant Addresses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantAddresses form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantAddress) ?>
    <fieldset>
        <legend><?= __('Edit Applicant Address') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('addr_line1');
            echo $this->Form->input('addr_line2');
            echo $this->Form->input('addr_line3');
            echo $this->Form->input('city');
            echo $this->Form->input('state');
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('postcode');
            echo $this->Form->input('phone_landline');
            echo $this->Form->input('phone_mobile');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
