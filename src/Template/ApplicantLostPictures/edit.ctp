<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $applicantLostPicture->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $applicantLostPicture->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Applicant Lost Pictures'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lost Items'), ['controller' => 'LostItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lost Item'), ['controller' => 'LostItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicantLostPictures form large-9 medium-8 columns content">
    <?= $this->Form->create($applicantLostPicture) ?>
    <fieldset>
        <legend><?= __('Edit Applicant Lost Picture') ?></legend>
        <?php
            echo $this->Form->input('lost_item_id', ['options' => $lostItems]);
            echo $this->Form->input('picture');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
