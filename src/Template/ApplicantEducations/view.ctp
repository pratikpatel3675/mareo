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

//debug($countries->toArray());
echo $this->Html->script('applicantProfileEducationView', ['block' => 'scriptBottom']);

?>


<div class='col-md-12'>
    <div class="applicantEducations view large-9 medium-8 columns content">
        <h3>
        <?php echo $this->Html->link(
            $this->Html->tag('span','',['class' => 'glyphicon glyphicon-edit']).' ' . __('btn_edit'),
            ['action' => 'edit', $applicantEducation->id],
            ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
            );
        ?>
        </h3>

        <table class="table">
            <tr>
                <th><?= __('Education Level') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantEducation->education_level->name_en) : h($applicantEducation->education_level->name_ara) ?>
                </td>
            </tr>
            <tr>
                <th><?= __('Country') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantEducation->country->name_en) : h($applicantEducation->country->name_ara) ?>
                </td>
            </tr>
            <tr>
                <th><?= __('Year') ?></th>
                <td><?= h($applicantEducation->year) ?></td>
            </tr>
            <tr>
                <th><?= __('Has Evidence') ?></th>
                <td>
                <?= 
                    ($applicantEducation->has_evidence == 0) ? h(__('No')) : h(__('Yes'));
                ?>  
                </td>
            </tr>
            <tr>
                <th><?= __('Language') ?></th>
                <td><?= $_language == 'en_US' ? h($applicantEducation->language->name_en) : h($applicantEducation->language->name_ara) ?>
                    
                </td>
            </tr>
            <tr>
                <th><?= __('IT Skills Rating') ?></th>
                <td><?php
                     switch ($applicantEducation->it_skills_rating) {
                        case '1':
                            echo(__('Poor'));
                            break;
                        case '2':
                            echo(__('Fair'));
                            break;
                        case '3':
                            echo(__('Good'));
                            break;
                        case '4':
                            echo(__('Excellent'));
                            break;
                     }
                 ?>    
                 </td>
            </tr>
            <tr>
                <th><?= __('Institution Higher Education') ?></th>
                <td><?= $applicantEducation->has('institution_higher_education') ? $this->Html->link($applicantEducation->institution_higher_education->name, ['controller' => 'InstitutionHigherEducations', 'action' => 'view', $applicantEducation->institution_higher_education->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Institution Higher Education Faculty') ?></th>
                <td><?= $applicantEducation->has('institution_higher_education_faculty') ? h($applicantEducation->institution_higher_education_faculty->name) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Institution Higher Education Course') ?></th>
                <td><?= $applicantEducation->has('institution_higher_education_course') ? h($applicantEducation->institution_higher_education_course->name) : '' ?></td>
            </tr>
        </table>
    </div>

</div>