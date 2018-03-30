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

$this->layout = 'country';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

//echo debug($test);

?>

<div id="mapid"  style="position: absolute; left: 0px; top: 0px; z-index: -1; width: 100%; height: 360px;"></div>
<div class="countries view large-9 medium-8 columns content">

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default text-center">
            <div class="panel-body">
            <img class="img-responsive" src=/img/flags/<?= h($country->flag_file_name) ?> >
            <h2><?= h($country->name) ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-3">
        <div class="panel panel-default text-center">
            <div class="panel-body">
            <h1><?= h($nb_hosted_applicants) ?> <i class="fa fa-users" aria-hidden="true"></i></h1>
            <small><?= __('HostedApplicants') ?></small>
            <h1><?= h($nb_opportunity_seekers) ?> <i class="fa fa-binoculars" aria-hidden="true"></i></h1>
            <small><?= __('OpportunitySeekers') ?></small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default text-center">
            <div class="panel-body">
            <h1><?= h($nb_institutions) ?> <i class="fa fa-university" aria-hidden="true"></i></h1>
            <small><?= __('Institutions') ?></small>
            <h1>150 <i class="fa fa-graduation-cap" aria-hidden="true"></i></h1>
            <small><?= __('OnlineOpportunities') ?></small>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="page-header">
            <h1><?= __('Welcome') ?><small><?= __('to') ?><?= h($country->name) ?></small></h1>
        </div>

        <h3><?= $this->Text->autoParagraph(h($country->title1)); ?></h3>
        <?= $this->Text->autoParagraph(h($country->text1)); ?>

        <h3><?= $this->Text->autoParagraph(h($country->title2)); ?></h3>
        <?= $this->Text->autoParagraph(h($country->text2)); ?>

        <h3><?= $this->Text->autoParagraph(h($country->title3)); ?></h3>
        <?= $this->Text->autoParagraph(h($country->text3)); ?>
    </div>

    <div class="col-md-4">
        <div class="page-header">
            <h1><?= __('LatestOpportunities') ?></h1>
        </div>
        
    </div>
</div>


    
</div>

</div>



