
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hoverbox Image Gallery</title>
<link rel="stylesheet" href='/css/hoverbox.css' type="text/css" media="screen, projection" />
<!--[if lte IE 7]>
<link rel="stylesheet" href='css/ie_fixes.css' type="text/css" media="screen, projection" />
<![endif]-->
</head>

<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default_white';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;


//echo debug($files);die;


?>






<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <div class ='col-md-6'>
            <h3><?= h($lostItems->name) ?></h3>
        </div>
        <div class ='col-md-6'>
            <h3><?= h($lostItems->name) ?></h3>
        </div>
    </div>
</div>
<?     ?>

<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <div class ='col-md-6'>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= __('Item Details') ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table vertical-table">
                    
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($lostItems->name) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Losting Date') ?></th>
                             <td><?= h($lostItems->lost_date) ?></td>                      
                        </tr>                            

                        <tr>
                            <th><?= __('country') ?></th>
                            <td><?= h($lostItems->country->name_en) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Item Type') ?></th>
                            <td><?= h($lostItems->item_type->name) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($lostItems->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($lostItems->modified) ?></td>


                    </table>
                </div>
            </div>
        </div>

        <div class ='col-md-6'>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class ='col-md-4'>
                 
                    <?php   echo $this->Html->link(
                    $this->Html->tag('span','',['class' => 'glyphicon glyphicon']).' ' . __('Messages'),
                    ['controller' => 'Messages', 'action' => 'add', $lostItems->id],
                    ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
                    );  ?>
                           


                    </div>
                    <div class ='col-md-4'>
                        <h1> <i class="fa fa-users" aria-hidden="true"></i></h1>
                        <small><?= __('Enrolled Applicants') ?></small>
                    </div>
         
     


                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Images</h3>
                </div>
                <div class="panel-body">
                        

                    <!DOCTYPE html>
<?php foreach($files as $file):   ?>

<body>
<ul class="hoverbox">
<li>       
    <?php 
$r='/';
     //echo $r.$file->path.$file->name; ?>     
<a href="#"><img  src="<?=$r.$file->path.$file->name?>" alt="description" /><img src="<?=$r.$file->path.$file->name?>" alt="description" class="preview" /></a>
</li>


</ul>
 <?php endforeach; ?>
</body>
</html>
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
                <p>                 
                           
                            <?= h($lostItems->description) ?>
                </p>
            </div>

        </div>
    </div>
</div>




<div class='col-md-12'>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Select the area on the map.</h3>
        </div>
        <div class="panel-body">
            





        </div>

