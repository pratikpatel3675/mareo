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

$this->layout = 'default';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;


?>     


      <div class="row featurette">
        <div class="col-md-12">
          
         <h2> <?= __('Contact_Us') ?></h2>
          <div class="row">
            <div class="col-md-8">

            <p><?=__('contact_text_1')?></p>
            
            <p>
              <address>
              <strong><?=  __('contact_text_2') ?></strong><br>
              <a href="mailto:#">jami3ti@unesco.org</a>
              </address>
            </p>

            <p>
             <img class="featurette-image img-responsive center-block" src="/img/logos/logo_unesco_syria_crisis.jpg" alt="Generic placeholder image">
            </p>

           
            </div>
            <div class="col-md-4">
              <address>
                <strong><?=__('UNESCO_Amman_Office')?></strong><br>
                <?=__('1355_Market_Street,_Suite_900')?><br>
                <?=__('San Francisco, CA 94103')?><br>
                <abbr title="Phone">P:</abbr> <?=__('(123)456-7890')?>
              </address>
              <address>
                <strong><?=('UNESCO_Beirut_Office')?></strong><br>
                   <?=__('1355_Market_Street,_Suite_900')?><br>
                <?=__('San_Francisco,_CA_94103')?><br>
                <abbr title="Phone">P:</abbr> <?=__('(123) 456-7890')?>
              </address>
              <address>
               
                <strong><?=('UNESCO_Bagdad_Office')?></strong><br>
                     <?=__('1355_Market_Street,_Suite_900')?><br>
                <?=__('San_Francisco,_CA_94103')?><br>
                <abbr title="Phone">P:</abbr> <?=__('(123) 456-7890')?>
              </address>

            </div>
          </div>

        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


