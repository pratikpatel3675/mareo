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

<div class="applicantOthers view large-9 medium-8 columns content">
        <h3>
        <?php echo $this->Html->link(
            $this->Html->tag('span','',['class' => 'glyphicon glyphicon-edit']).' ' . __('Edit'),
            ['action' => 'edit', $applicantOther->id],
            ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
            );
        ?>
        </h3>
    <table class="table">
        <tr>
            <th><?= __('Need_Monthly_Accomodation') ?></th>
            <td>
            <?= 
                ($applicantOther->need_monthly_accomodation == 0) ? h(__('No')) : h(__('Yes'));
            ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Need_Monthly_Meal_Costs') ?></th>
            <td>
            <?= 
                ($applicantOther->need_monthly_meal_costs == 0) ? h(__('No')) : h(__('Yes'));
            ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Need_Other_Monthly_Allowances') ?></th>
            <td>
            <?= 
                ($applicantOther->need_other_monthly_allowances == 0) ? h(__('No')) : h(__('Yes'));
            ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Need_Tuition_Fees') ?></th>
            <td>
            <?= 
                ($applicantOther->need_tuition_fees == 0) ? h(__('No')) : h(__('Yes'));
            ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Need_Transport_Fees') ?></th>
            <td>
            <?= 
                ($applicantOther->need_transport_fees == 0) ? h(__('No')) : h(__('Yes'));
            ?>
            </td>
        </tr>
    </table>
</div>
