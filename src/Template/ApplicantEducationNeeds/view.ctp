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

$this->layout = 'applicantProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//echo debug($applicantDesiredEducations);

?>

<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">

        <div class ='col-md-4'>
            <h3>Desired Education</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= __('Field Of Studies') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applicantDesiredEducations as $applicantDesiredEducation): ?>
                        <tr>
                            <td><?= $_language == 'en_US' ? h($applicantDesiredEducation->education_field_of_study_sub->name_en) : h($applicantDesiredEducation->education_field_of_study_sub->name_ara) ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'ApplicantDesiredEducations', 'action' => 'delete', $applicantDesiredEducation->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>  

                </table>
                <p>
                <?php echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add'),
                    ['controller' => 'ApplicantDesiredEducations', 'action' => 'add'],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
                ?>
                </p>
        </div>

        <div class ='col-md-4'>
            <h3>Desired Type</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= __('Desired Type of Education') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applicantDesiredEducationTypes as $applicantDesiredEducationType): ?>
                        <tr>
                            <td><?= $_language == 'en_US' ? h($applicantDesiredEducationType->education_desired_type->name_en) : h($applicantDesiredEducationType->education_desired_type->name_ara) ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'ApplicantDesiredEducationTypes', 'action' => 'delete', $applicantDesiredEducationType->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>  
                </table>
                <p>
                <?php echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add'),
                    ['controller' => 'ApplicantDesiredEducationTypes', 'action' => 'add'],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
                ?>
                </p>
        </div>

        <div class ='col-md-4'>
            <h3>Desired Countries</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= __('Country') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applicantDesiredCountries as $applicantDesiredCountry): ?>
                        <tr>
                            <td><?php echo $this->Html->link(
                                    $_language == 'en_US' ? h($applicantDesiredCountry->country->name_en) : h($applicantDesiredCountry->country->name_ara),
                                    ['controller' => 'Countries', 'action' => 'view', $applicantDesiredCountry->country->code], 
                                    ['escape' => false])



                            //$_language == 'en_US' ? h($applicantDesiredCountry->country->name_en) : h($applicantDesiredCountry->country->name_ara) ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'ApplicantDesiredCountries', 'action' => 'delete', $applicantDesiredCountry->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>  
                </table>
                <p>
                <?php echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add'),
                    ['controller' => 'ApplicantDesiredCountries', 'action' => 'add'],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
                ?>
                </p>
        </div>
    </div>
</div>

<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">


        <div class ='col-md-12'>
            <h3>Desired Institutions</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= __('Institution') ?></th>
                            <th><?= __('Faculty') ?></th>
                            <th><?= __('Course') ?></th>
                            <th><?= __('Country') ?></th>
                            <th><?= __('Initiated Registration') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applicantDesiredInstitutions as $applicantDesiredInstitution): ?>
                        <tr>
                            <td><?= $this->Html->link($applicantDesiredInstitution->institution_higher_education->name, ['controller' => 'InstitutionHigherEducations', 'action' => 'view', $applicantDesiredInstitution->institution_higher_education->id]) ?></td>
                            <td><?= h($applicantDesiredInstitution->institution_higher_education_faculty->name) ?></td>
                            <td><?= h($applicantDesiredInstitution->institution_higher_education_course->name) ?></td>
                            <td><?= $_language == 'en_US' ? h($applicantDesiredInstitution->country->name_en) : h($applicantDesiredInstitution->country->name_ara) ?></td>
                            <td><?= ($applicantDesiredInstitution->is_already_registered == 0) ? h(__('No')) : h(__('Yes')); ?></td>
                            <td class="actions">
                                <?= $this->Html->link('<i class="fa fa-pencil" aria-hidden="true"></i>',['controller' => 'ApplicantDesiredInstitutions', 'action' => 'edit', $applicantDesiredInstitution->id], ['escape' => false]) ?>
                                <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'ApplicantDesiredInstitutions', 'action' => 'delete', $applicantDesiredInstitution->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>  
                </table>
                <p>
                <?php echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add'),
                    ['controller' => 'ApplicantDesiredInstitutions', 'action' => 'add'],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
                ?>
                </p>
        </div>

    </div>
</div>



