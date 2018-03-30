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

//  debug($lostitems);die;


?>

<div class='col-md-12'>
    <div class="view large-9 medium-8 columns content">

        <div class ='col-md-12'>
            <h3><?= __('Items List') ?></h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Founding Date') ?></th>
                            <th><?= __('Country') ?></th>
                            <th><?= __('Item type') ?></th>
                            <th><?= __('Last Status') ?></th>

                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                      

                        <?php foreach ($founditems as $founditem): ?>
                    
             
                       
                        <tr>
                            <td><?= $founditem->name?></td>
                            <td><?= $founditem->description ?></td>
                            <td><?= h($founditem->lost_date) ?></td>
                            <td><?= h($founditem->country->name_en) ?></td>
                            <td><?= h($founditem->item_type->name) ?></td>
                            <td><?php
                                  switch ($founditem->last_status) {
                                  case '1':
                                  echo(__('It was found'));
                                  break;
                                  case '0':
                                  echo(__('Still Lost!'));
                                  break;
                                  }
                                 ?>    
                 </td>


                            <td class="actions">
                                <?= $this->Form->postLink('<i class="fa fa-eye" aria-hidden="true"></i>', ['controller' => 'FoundItems', 'action' => 'viewProvider', $founditem->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'FoundItems', 'action' => 'delete', $founditem->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?></td>
             
                        </tr>
                       
                        <?php    endforeach; ?>
                    </tbody>  

                </table>
                    <?php 
                    echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add New Found Item'),
                    ['controller' => 'FoundItems', 'action' => 'add'],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
                     ?>
                </p>
        </div>
        
    </div>
</div>
