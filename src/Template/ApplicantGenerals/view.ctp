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
use Cake\ORM\TableRegistry;

$this->layout = 'applicantProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//echo debug($applicantGeneral);

?>

<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <h3>
        <?php echo $this->Html->link(
            $this->Html->tag('span','',['class' => 'glyphicon glyphicon-edit']).' ' . __('btn_edit'),
            ['action' => 'edit', $applicantGeneral->id],
            ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
            );
        ?>
        </h3>

        <div class ='col-md-6'>
            <table class="table">
            <tr>
                <th><?= __('Fisrtname') ?></th>
                <td><?= h($applicantGeneral->fisrtname) ?></td>
            </tr>
            <tr>
                <th><?= __('Lastname') ?></th>
                <td><?= h($applicantGeneral->lastname) ?></td>
            </tr>
            <tr>
                <th><?= __('Birthdate') ?></th>
                <td><?= h($applicantGeneral->birthdate) ?></td>
            </tr>
            <tr>
                <th><?= __('Gender') ?></th>
                <td><?= h($applicantGeneral->gender->name_en) ?></td>
            </tr>
            <tr>
                <th><?= __('WhatsApp enabled mobile phone number') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantGeneral->whatsapp_number) : h($applicantGeneral->whatsapp_number) ?></td>
            </tr>
            </table>
        </div>

        <div class ='col-md-6'>
            <table class="table">


             <tr>
                <th><?= __('What country do you currently live in?') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantGeneral->country->name_en) : h($applicantGeneral->country->name_ara) ?></td>
            </tr>           

            <tr> 
                <th><?= __('Nationality') ?></th>
                <td><?php 
                          $resCountry = TableRegistry::get('Countries')->get($applicantGeneral->nationality_id);
                            echo  $resCountry->name_en;
                 ?></td>
            </tr>


            <tr>
                <th><?= __('Are you an expat in this currently country ?') ?></th>
             <td><?= h($applicantGeneral->is_expat == 0) ? h(__('No')) : h(__('Yes'));?></td>
            </tr>


            <tr>
                <th><?= __('What city do you currently live in ?') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantGeneral->city) : h($applicantGeneral->city) ?></td>
            </tr>
           


            <tr>
                <th><?= __('Other Phone mobile Number') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantGeneral->whatsapp_number) : h($applicantGeneral->whatsapp_number) ?></td>
            </tr>

            </table>
        </div>


       
