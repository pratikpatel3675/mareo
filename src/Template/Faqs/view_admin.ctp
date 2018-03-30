<?php

use Cake\ORM\TableRegistry;
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

$this->layout = 'providerProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//echo debug();

?><div class="admins index large-9 medium-8 columns content">
    <h3><?= __('Requests pending UNESCO validation') ?></h3>
        <table class="table table-bordered">
        <thead>
            <tr>
                
                <th class="col-md-3"><?= $this->Paginator->sort('user_id') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('question_en') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('answer_en') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('question_ara') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('answer_ara') ?></th>               
                <th class="col-md-3"><?= $this->Paginator->sort('country_id') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('is_active') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('created') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
       



            </tr>
        </thead>
        <tbody>








            <?php foreach ($faqs as $faq): ?>
            <tr>
                
                <td><?= $faq->has('user') ? $this->Html->link($faq->user->username, ['controller' => 'Users', 'action' => 'view', $faq->user->id]) : '' ?></td>
                <td><?= h($faq->question_en) ?></td>
                <td><?= h($faq->answer_en) ?></td>
                <td><?= h($faq->question_ara) ?></td>
                <td><?= h($faq->answer_ara) ?></td>             
                <td><?= $faq->has('country') ? $this->Html->link($faq->country->name_en, ['controller' => 'Users', 'action' => 'view', $faq->user->id]) : '' ?></td>
                <td><?php
                     switch ($faq->is_active) {
                        case '1':
                            echo(__('Processed'));
                            break;
                        case '0':
                            echo(__('Pending'));
                            break;
                     }
                 ?>    
                 </td>
               
                <td><?= h($faq->created) ?></td>
                <td><?= h($faq->modified) ?></td>
                <td class="actions">

        <?= $this->Html->link(__('Action'), ['controller' =>'Faqs' ,'action' => 'action', $faq->id]) ?>
                     <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>',['controller' =>'Faqs' ,'action' => 'edit', $faq->id] , ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' =>'Faqs' ,'action' => 'delete', $faq->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]);
                                            ?>









                </td>
            
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>







<div class="admins index large-9 medium-8 columns content">
    <h3><?= __('Processed Requests') ?></h3>
        <table class="table table-bordered">
        <thead>
            <tr>
                
                <th class="col-md-3"><?= $this->Paginator->sort('user_id') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('question_en') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('answer_en') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('question_ara') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('answer_ara') ?></th>               
                <th class="col-md-3"><?= $this->Paginator->sort('country_id') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('is_active') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('created') ?></th>
                <th class="col-md-3"><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
       



            </tr>
        </thead>
        <tbody>








            <?php foreach ($faqs1 as $faq1): ?>
            <tr>
                
                <td><?= $faq1->has('user') ? $this->Html->link($faq1->user->username, ['controller' => 'Users', 'action' => 'view', $faq1->user->id]) : '' ?></td>
                <td><?= h($faq1->question_en) ?></td>
                <td><?= h($faq1->answer_en) ?></td>
                <td><?= h($faq1->question_ara) ?></td>
                <td><?= h($faq1->answer_ara) ?></td>             
                <td><?= $faq1->has('country') ? $this->Html->link($faq1->country->name_en, ['controller' => 'Users', 'action' => 'view', $faq1->user->id]) : '' ?></td>
                <td><?php
                     switch ($faq1->is_active) {
                        case '1':
                            echo(__('Processed'));
                            break;
                        case '0':
                            echo(__('Pending'));
                            break;
                     }
                 ?>    
                 </td>
               
                <td><?= h($faq1->created) ?></td>
                <td><?= h($faq1->modified) ?></td>
                <td class="actions">
                     <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>',['controller' =>'Faqs' ,'action' => 'edit', $faq->id] , ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' =>'Faqs' ,'action' => 'delete', $faq->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]);
                                            ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
