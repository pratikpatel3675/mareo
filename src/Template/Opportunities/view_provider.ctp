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

//echo debug();
?>

<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <div class ='col-md-6'>
            <h3><?= h($opportunity->name_en) ?></h3>
        </div>
        <div class ='col-md-6'>
            <h3><?= h($opportunity->name_ara) ?></h3>
        </div>
    </div>
</div>


<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <div class ='col-md-6'>
            <p>
                <?php
                echo $this->Html->link(
                        $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']) . ' ' . __('Edit'), ['controller' => 'Opportunities', 'action' => 'edit', $opportunity->id], ['class' => 'btn btn-info', 'role' => 'button', 'escape' => false]
                );
                ?>
            </p> 
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= __('Opportunity Details') ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table vertical-table">
                        <tr>
                            <th><?= __('Opportunity Duration') ?></th>
                            <td><?= $opportunity->has('opportunity_duration') ? h($opportunity->opportunity_duration->name_en) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Opportunity Scope') ?></th>
                            <td><?= $opportunity->has('opportunity_scope') ? h($opportunity->opportunity_scope->name_en) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Budget') ?></th>
                            <td><?= $this->Number->format($opportunity->budget) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Currency') ?></th>
                            <td><?= $opportunity->has('currency') ? $this->Html->link($opportunity->currency->name, ['controller' => 'Currencies', 'action' => 'view', $opportunity->currency->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Seats') ?></th>
                            <td><?= $this->Number->format($opportunity->seats) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Application End Date') ?></th>
                            <td><?= h($opportunity->application_end_date) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($opportunity->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($opportunity->modified) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class ='col-md-6'>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class ='col-md-4'>
                        <h1><?= h($nbApplicantSeekers) ?> <i class="fa fa-binoculars" aria-hidden="true"></i></h1>
                        <small><?= __('OpportunitySeekers') ?></small>
                    </div>
                    <div class ='col-md-4'>
                        <h1><?= h($nbApplicantAccepted) ?> <i class="fa fa-users" aria-hidden="true"></i></h1>
                        <small><?= __('Enrolled Applicants') ?></small>
                    </div>
                    <div class ='col-md-4'>
                        <h1><?= h($percentage) ?> %</h1>
                        <small><?= __('Occupied Seats') ?></small>
                    </div>
     


                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Funding Source</h3>
                </div>
                <div class="panel-body">
                    <p><b><?= __('Donor') ?>: </b><?= h($opportunity->donation_campaign_provider->donation_campaign->donor->name) ?></p>
                    <p><b><?= __('Campaign Name') ?>: </b><?= h($opportunity->donation_campaign_provider->donation_campaign->name) ?></p>
                    <p><b><?= __('Description') ?>: </b><?= h($opportunity->donation_campaign_provider->donation_campaign->description) ?></p>
                    <p><b><?= __('Requirements') ?>: </b><?= h($opportunity->donation_campaign_provider->donation_campaign->requirements) ?></p>
                    <p><b><?= __('Total Budget') ?>: </b><?= h($opportunity->donation_campaign_provider->donation_campaign->budget) ?> <?= h($opportunity->donation_campaign_provider->donation_campaign->currency) ?></p>
                    <p><b><?= __('Start Date') ?>: </b><?= h($opportunity->donation_campaign_provider->start_date) ?></p>
                    <p><b><?= __('End Date') ?>: </b><?= h($opportunity->donation_campaign_provider->end_date) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class='col-md-12'>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Description</h3>
        </div>
        <div class="panel-body">
            <div class ='col-md-6'>
                <p><?= h($opportunity->description_en) ?></p>
            </div>
            <div class ='col-md-6'>
                <p><?= h($opportunity->description_ara) ?></p>
            </div>
        </div>
    </div>
</div>




<div class='col-md-12'>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Target Audience</h3>
        </div>
        <div class="panel-body">
            <div class="applicantGenerals view large-9 medium-8 columns content">
                <div class ='col-md-4'>
                    <h4>Target Fields of Study</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= __('Name En') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($opportunity->opportunity_educations as $educationSub): ?>
                                    <tr>
                                        <td><?php
                                echo
                                $_language == 'en_US' ? h($educationSub->education_field_of_study_sub->name_en) : h($educationSub->education_field_of_study_sub->name_ara)
                                    ?></td>
                                        <td class="actions">
                                            <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'OpportunityEducations', 'action' => 'delete', $educationSub->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>  
                        </table>
                        <p>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-plus']) . ' ' . __('Add'), ['controller' => 'OpportunityEducations', 'action' => 'add', $opportunity->id], ['class' => 'btn btn-info', 'role' => 'button', 'escape' => false]
                            );
                            ?>
                        </p> 
                </div>

                <div class ='col-md-4'>
                    <h4><?= __('Target Levels') ?></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?= __('Name En') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($opportunity->opportunity_education_types as $educationTypes): ?>
                                <tr>
                                    <td><?php
                            echo
                            $_language == 'en_US' ? h($educationTypes->education_desired_type->name_en) : h($educationTypes->education_desired_type->name_ara)
                                ?></td>
                                    <td class="actions">
                                        <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'OpportunityEducationTypes', 'action' => 'delete', $educationTypes->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>  
                    </table>
                    <p>
                        <?php
                        echo $this->Html->link(
                                $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-plus']) . ' ' . __('Add'), ['controller' => 'OpportunityEducationTypes', 'action' => 'add', $opportunity->id], ['class' => 'btn btn-info', 'role' => 'button', 'escape' => false]
                        );
                        ?>
                    </p>            
                </div>

                <div class ='col-md-4'>
                    <h4>Target Countries</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= __('Country') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($opportunity->opportunity_countries as $opportunityCountry): ?>
                                    <tr>
                                        <td><?php
                                echo $this->Html->link(
                                        $_language == 'en_US' ? h($opportunityCountry->country->name_en) : h($opportunityCountry->country->name_ara), ['controller' => 'Countries', 'action' => 'view', $opportunityCountry->country->code], ['escape' => false])
                                    ?></td>
                                        <td class="actions">
                                            <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'OpportunityCountries', 'action' => 'delete', $opportunityCountry->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>  
                        </table>
                        <p>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-plus']) . ' ' . __('Add'), ['controller' => 'OpportunityCountries', 'action' => 'add', $opportunity->id], ['class' => 'btn btn-info', 'role' => 'button', 'escape' => false]
                            );
                            ?>
                        </p>
                </div>
            </div>
            <div class="applicantGenerals view large-9 medium-8 columns content">
                <div class ='col-md-12'>
                    <h4>Target Institutions</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= __('Institution') ?></th>
                                    <th><?= __('Email') ?></th>
                                    <th><?= __('Website') ?></th>
                                    <th><?= __('Country') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($opportunity->opportunity_institutions as $opportunity_institution): ?>
                                    <tr>
                                        <td><?= $this->Html->link($opportunity_institution->institution_higher_education->name, ['controller' => 'InstitutionHigherEducations', 'action' => 'view', $opportunity_institution->institution_higher_education->id]) ?></td>
                                        <td><?= h($opportunity_institution->institution_higher_education->email) ?></td>
                                        <td><?= h($opportunity_institution->institution_higher_education->website) ?></td>
                                        <td><?= $_language == 'en_US' ? h($opportunity_institution->institution_higher_education->country->name_en) : h($opportunity_institution->institution_higher_education->country->name_ara) ?></td>
                                        <td class="actions">
                                            <?= $this->Form->postLink('<i class="fa fa-trash" aria-hidden="true"></i>', ['controller' => 'OpportunityInstitutions', 'action' => 'delete', $opportunity_institution->id], [['confirm' => __('Are you sure you want to delete this record ?')], 'escape' => false]);
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>  
                        </table>
                        <p>
                            <?php
                            echo $this->Html->link(
                                    $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-plus']) . ' ' . __('Add'), ['controller' => 'OpportunityInstitutions', 'action' => 'add', $opportunity->id], ['class' => 'btn btn-info', 'role' => 'button', 'escape' => false]
                            );
                            ?>
                        </p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">

     <div class='col-md-3'>
         <img class="img-responsive" src=/img/Recommended.jpg ?>
     </div>
     <div class="col-xs-6 col-md-6">

         <div class="panel panel-default">
               <div class="panel-heading">

                 <h3 align="center" ><?= __('Recommended Applicants') ?></h3>


                 <table class="table">
                    <thead>
                    <th><h4 align="center" ><?= __('Jami3ti Applicants Matching Your Opportunity') ?></h4></th>

                    </thead>
                

                    <div class="panel-body">


                                     <tr>
                   
                                         <td align="center">                    <?php
                    $sendEmail = [];
                    if (count($userInformation) > 0) {
                        foreach ($userInformation as $userData) {
                            $sendEmail[] = $userData->email;
                        }
                        echo "Total number of recommended Applicant(s)! Now: <b>" . count($userInformation) . "</b> You can  send them a message";
                    } else {
                        echo "No Record(s) found.";
                    }

                ?>
                                         </td> 

                                    </tr>
                                     <tr>
                   
                                         <td align="center">   
                   
<?php   if($opportunity->is_active){
        echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Broadcasting'),
                    ['controller' => 'Messages', 'action' => 'add', $opportunity->id],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );
               
               } 
else {   ?>   <button type="" class="btn btn-danger  btn-lg disabled">You cannot Broadcast this opportunity until admin verification </button>  <?php
}



               ?>




                        </td> 
                                   </tr>
                 </table>
               </div>
        
         </div>      



      </div>
</div>
                 </div>

