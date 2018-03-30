





<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default_white';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//echo debug();

?>






<div class="opportunities index large-9 medium-8 columns content">
    <h2><?= __('Browse Lost Items') ?></h2>


    <div class="col-md-12">

            <div class="col-lg-12">
            <?= $this->Form->create(null, ['url' => ['action' => 'index']]) ?>
                <div class="input-group">
                    <?= $this->Form->input('keyword', ['label' => false, 'type'=>'text','class'=>'form-control', 'placeholder' => __('Search for...')]); ?>
                    <span class="input-group-btn">
                    <?= $this->Form->button(__('Go'), ['class' => 'btn btn-default', 'type' => 'submit']) ?>
                  </span>
                </div><!-- /input-group -->
            <?= $this->Form->end() ?>
            </div>

    </div>

    <div class="col-md-12">
    <h3><?= __('Search Results')?>:</h3>
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= __('Title') ?></th>
                        <th><?= __('Lost Date') ?></th>
                        <th><?= __('Username') ?></th>
                        <th><?= __('Country') ?></th>
                        <th><?= __('Item type') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lostItems as $lostItem): ?>
                    <tr>
                <td><?= h($lostItem->name) ?></td>
                <td><?= h($lostItem->lost_date) ?></td>
                <td><?= $lostItem->has('user') ? $this->Html->link($lostItem->user->username, ['controller' => 'Users', 'action' => 'view', $lostItem->user->id]) : '' ?></td>
         
                <td><?= $lostItem->has('country') ? $this->Html->link($lostItem->country->name_en, ['controller' => 'Countries', 'action' => 'view', $lostItem->country->id]) : '' ?></td>
                <td><?= $lostItem->has('item_type') ? $this->Html->link($lostItem->item_type->name, ['controller' => 'ItemTypes', 'action' => 'view', $lostItem->item_type->id]) : '' ?></td>
                <td class="actions">
                <?= $this->Form->postLink('<i class="fa fa-eye" aria-hidden="true"></i>', ['controller' => 'LostItems', 'action' => 'view', $lostItem->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>





    
</div>
