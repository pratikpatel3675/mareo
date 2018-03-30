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
?>

<div id="mapid"  style="position: absolute; left: 0px; top: 0px; z-index: -1; width: 100%; height: 330px;"></div>
<div class="countries view large-9 medium-8 columns content">

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default text-center"">
            <div class="panel-body">
            <i class="fa fa-globe fa-4x" aria-hidden="true"></i>
            <h2><?= __('Heading')?></h2>
            <p><?= __('HeadingText') ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-8"></div>
</div>

<div class="row">
    <div class="col-md-12">

    <?php 
        $session = $this->request->session();
        $lang = $session->read('System.language.code');
    ?>
    
    <?php foreach ($country_pages as $country): ?>
        
        <?php 
        if ($lang == 'en_US'){
            $country['name'] = $country->name_en;
            $country['title1'] = $country->title1_en;
            $country['text1'] = $country->text1_en;
            $country['title2'] = $country->title2_en;
            $country['text2'] = $country->text2_en;
            $country['title3'] = $country->title3_en;
            $country['text3'] = $country->text3_en;

        }
        else{
            $country['name'] = $country->name_ara;
            $country['title1'] = $country->title1_ara;
            $country['text1'] = $country->text1_ara;
            $country['title2'] = $country->title2_ara;
            $country['text2'] = $country->text2_ara;
            $country['title3'] = $country->title3_ara;
            $country['text3'] = $country->text3_ara;

        }


        ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <?php
                            echo $this->Html->image("/img/flags/" . h($country['flag_file_name']), [
                            'url' => ['controller' => 'Countries', 'action' => 'view', $country->code],
                            'class' => 'img-responsive'
                            ]);
                        ?>
                    </div>
                    <div class="col-md-9">
                        <h2>
                        <?php
                            echo $this->Html->link(
                            h($country->name),
                            ['controller' => 'Countries', 'action' => 'view', $country->code]
                            );
                        ?>
                        </h2>
                        <h3><?= $this->Text->autoParagraph(h($country->title1)); ?></h3>
                        <?= $this->Text->autoParagraph(h($country->text1)); ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>


    </div>


</div>


    
</div>

</div>



