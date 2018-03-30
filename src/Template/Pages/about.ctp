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
<body>
      <div class="row featurette">
        <div class="col-md-12">
          <h2><?= __('about_title_part1') ?><span class="text-muted"><?= __('about_title_part2') ?></span></h2>
          <div class="row">
            <div class="col-md-8">
            <p style="text-align:justify"><?= __('about_text1') ?></p>
            <p style="text-align:justify"><?= __('about_text2') ?></p>
            <p style="text-align:justify"><?= __('about_text3') ?></p>
             
        <div >
        <iframe width="560" height="315" src="https://www.youtube.com/embed/s691zzvyZyk" frameborder="0" allowfullscreen></iframe>
        </div>
</div>
            


            <div class="col-md-4">
              <img class="featurette-image img-responsive img-rounded center-block" src="/img/about1.jpg" alt="Generic placeholder image">
             
           
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v2.2";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>






<div class="fb-page" data-href="https://www.facebook.com/UNESCOAmman/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/UNESCOAmman/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/UNESCOAmman/">UNESCO Amman Office</a></blockquote></div>

<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUNESCOAmman%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=1540943859524170" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>


<small><span style="margin:0 auto">© UNESCO/QRTA-UNESCO 2015</span></small>
              <img class="featurette-image img-responsive center-block" src="/img/logos/logo_unesco_syria_crisis.jpg" alt="Generic placeholder image">

            </div>
          </div>

        </div>
      </div>



      </div>



      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

</body>
