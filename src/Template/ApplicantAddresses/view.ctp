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


//echo debug($applicantGeneral);


?>

<div class="col-md-12">
    <div class="applicantAddresses view large-9 medium-8 columns content">
        <h3>
        <?php echo $this->Html->link(
            $this->Html->tag('span','',['class' => 'glyphicon glyphicon-edit']).' ' . __('Edit'),
            ['action' => 'edit', $applicantAddress->id],
            ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
            );
        ?>
        </h3>
        <table class="table">
            <tr>
                <th><?= __('Address 1') ?></th>
                <td><?= h($applicantAddress->addr_line1) ?></td>
            </tr>
            <tr>
                <th><?= __('Address 2') ?></th>
                <td><?= h($applicantAddress->addr_line2) ?></td>
            </tr>
            <tr>
                <th><?= __('Address 3') ?></th>
                <td><?= h($applicantAddress->addr_line3) ?></td>
            </tr>
            <tr>
                <th><?= __('City') ?></th>
                <td><?= h($applicantAddress->city) ?></td>
            </tr>
            <tr>
                <th><?= __('State') ?></th>
                <td><?= h($applicantAddress->state) ?></td>
            </tr>
            <tr>
                <th><?= __('Country') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantAddress->country->name_en) : h($applicantAddress->country->name_ara) ?>
            </tr>
            <tr>
                <th><?= __('Postcode') ?></th>
                <td><?= h($applicantAddress->postcode) ?></td>
            </tr>
            <tr>
                <th><?= __('Phone Landline') ?></th>
                <td><?= h($applicantAddress->phone_landline) ?></td>
            </tr>
            <tr>
                <th><?= __('Phone Mobile') ?></th>
                <td><?= h($applicantAddress->phone_mobile) ?></td>
            </tr>
      
        </table>
    </div>
</div>
         