


<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'applicantProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

echo $this->Html->script('userProfileGeneral', ['block' => 'scriptBottom']);
?>





<div class="lostItems form large-9 medium-8 columns content">
    <?= $this->Form->create($lostItem) ?>
    <fieldset>
        <legend><?= __('Add Lost Item') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description', ['type'=>'textArea','rows'=>'10', 'Description','label'=>__('Short Description')]);            
            echo $this->Form->input('lost_date', ['empty' => true]);
            echo $this->Form->input('country_id', ['options' => $countries]);
            echo $this->Form->input('item_type_id', ['options' => $itemTypes]);
       
      

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<h1>Upload File</h1>
<div class="content">
    <?= $this->Flash->render() ?>
    <div class="upload-frm">
        <?php echo $this->Form->create($uploadData, ['type' => 'file']); ?>
            <?php echo $this->Form->input('file', ['type' => 'file', 'class' => 'form-control']); ?>
            <?php echo $this->Form->button(__('Upload File'), ['type'=>'submit', 'class' => 'form-controlbtn btn-default']); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>




<h1>Uploaded Files</h1>
<div class="content">
    <!-- Table -->
    <table class="table">
        <tr>
            <th width="5%">#</th>
            <th width="20%">File</th>
            <th width="12%">Upload Date</th>
        </tr>
        <?php if($filesRowNum > 0):$count = 0; foreach($files as $file): $count++;?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><embed src="<?= $file->path.$file->name ?>" width="220px" height="150px"></td>
        </tr>
        <?php endforeach; else:?>
        <tr><td colspan="3">No file(s) found......</td>
        <?php endif; ?>
    </table>
</div>