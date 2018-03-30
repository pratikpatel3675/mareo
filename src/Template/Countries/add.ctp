<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Countries'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="countries form large-9 medium-8 columns content">
    <?= $this->Form->create($country) ?>
    <fieldset>
        <legend><?= __('Add Country') ?></legend>
        <?php
            echo $this->Form->input('code');
            echo $this->Form->input('name_en');
            echo $this->Form->input('name_ara');
            echo $this->Form->input('latitude');
            echo $this->Form->input('longitude');
            echo $this->Form->input('title1_en');
            echo $this->Form->input('title1_ara');
            echo $this->Form->input('text1_en');
            echo $this->Form->input('text1_ara');
            echo $this->Form->input('title2_en');
            echo $this->Form->input('title2_ara');
            echo $this->Form->input('text2_en');
            echo $this->Form->input('text2_ara');
            echo $this->Form->input('title3_en');
            echo $this->Form->input('title3_ara');
            echo $this->Form->input('text3_en');
            echo $this->Form->input('text3_ara');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
