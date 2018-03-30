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

$this->layout = 'providerProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//echo debug($applicantDesiredEducations);

?>

<div class='col-md-12'>
    <div class="view large-9 medium-8 columns content">

        <div class ='col-md-12'>
            <h3>Opportunites</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Opportunity Name</th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($opportunities as $opportunity): ?>
                        <tr>
                            <td><?= $_language == 'en_US' ? h($opportunity->name_en) : h($opportunity->name_ara) ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'Opportunities', 'action' => 'delete', $opportunity->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>  

                </table>
                <p>
                <?php echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add'),
                    ['controller' => 'Opportunities', 'action' => 'add'],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
                ?>
                </p>
        </div>
        
    </div>
</div>
