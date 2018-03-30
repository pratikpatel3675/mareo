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


$this->layout = 'home';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;


?>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide img-responsive" src="img/carroussel/carroussel1.jpg" alt="First slide" style="max-width: none; width: auto; height:100%;">
          <div class="container">
            <div class="carousel-caption">
              <h1><?= __('home_headline1_title') ?></h1>
              <p><?= __('home_headline1_text') ?></p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button"><?= __('home_headline1_button') ?></a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide img-responsive" src="img/carroussel/carroussel2.jpg" alt="Second slide" style="max-width: none; width: auto; height:100%;">
          <div class="container">
            <div class="carousel-caption">
              <h1><?= __('home_headline2_title') ?></h1>
              <p><?= __('home_headline2_text') ?></p>
              <p><?= $this->Html->link(__('home_headline2_button'), ['controller' => 'users', 'action' => 'register', 'applicant']) ?>
              <a class="btn btn-lg btn-primary" href="#" role="button"><?= __('home_headline2_button') ?></a>
              </p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide img-responsive" src="img/carroussel/slide5.png" alt="Third slide" style="max-width: none; width: auto; height:100%;">
          <div class="container">
            <div class="carousel-caption">
              <h1><?= __('home_headline3_title') ?></h1>
              <p><?= __('home_headline3_text') ?></p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button"><?= __('home_headline3_button') ?></a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only"><?= __('Previous') ?></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only"><?= __('Next') ?></span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
          <h2><?= __('home_circle1_title') ?></h2>
          <p><?= __('home_circle1_text') ?></p>
          <p><a class="btn btn-default" href="#" role="button"><?= __('view_details') ?> &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
          <h2><?= __('home_circle2_title') ?></h2>
          <p><?= __('home_circle2_text') ?></p>
          <p><a class="btn btn-default" href="#" role="button"><?= __('view_details') ?> &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
          <h2><?= __('home_circle3_title') ?></h2>
          <p><?= __('home_circle3_text') ?></p>
          <p><a class="btn btn-default" href="#" role="button"><?= __('view_details') ?> &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading"><?= __('home_featured1_title') ?> <span class="text-muted"><?= __('home_featured1_subtitle') ?></span></h2>
          <p class="lead"><?= __('home_featured1_text') ?></p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading"><?= __('home_featured2_title') ?> <span class="text-muted"><?= __('home_featured2_subtitle') ?></span></h2>
          <p class="lead"><?= __('home_featured2_text') ?></p>
        </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading"><?= __('home_featured3_title') ?> <span class="text-muted"><?= __('home_featured3_subtitle') ?></span></h2>
          <p class="lead"><?= __('home_featured3_text') ?></p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    </div>

