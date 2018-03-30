
<div class="lostItems form large-9 medium-8 columns content">
    <?= $this->Form->create($lostItem) ?>
    <fieldset>
        <legend><?= __('Edit Lost Item') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('lost_date', ['empty' => true]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('item_type_id', ['options' => $itemTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
