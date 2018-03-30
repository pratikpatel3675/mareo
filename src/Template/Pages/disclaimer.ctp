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

<h2><?=__('THIS_IS_THE_DISCLAIMER')?></span></h2>

      <div class="row featurette">
        <div class="col-md-12">
          <h2><?= __('disclaimer_title1') ?></span></h2>
          <div class="row">
            <div class="col-md-12">
            <p style="text-align:justify"><?= __('disclaimer_p1') ?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="row featurette">
        <div class="col-md-12">
          <h2><?= __('disclaimer_title2') ?></span></h2>
          <div class="row">
            <div class="col-md-12">
            <p style="text-align:justify"><?= __('disclaimer_p2') ?></p>
            <ul>
              <li><p style="text-align:justify"><?= __('sub1-disclaimer_p2') ?></p></li>
              <li><p style="text-align:justify"><?= __('sub2-disclaimer_p2') ?></p></li>
              
              </ul>

            </div>
          </div>
        </div>
      </div>

      <div class="row featurette">
        <div class="col-md-12">
          <h2><?= __('disclaimer_title3') ?></span></h2>
          <div class="row">
            <div class="col-md-12">
            <p style="text-align:justify"><?= __('disclaimer_p3') ?></p>
            <p style="text-align:justify"><?= __('disclaimer_p4') ?></p>

            </div>
          </div>
        </div>
      </div>





      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


