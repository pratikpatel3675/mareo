
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

$this->layout = 'applicantProfile';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;


//echo debug($files);die;


?>






<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <div class ='col-md-6'>
            <h3><?= h($lostitems->name) ?></h3>
        </div>

    </div>
</div>
<?     ?>

<div class='col-md-12'>
    <div class="applicantGenerals view large-9 medium-8 columns content">
        <div class ='col-md-6'>
            <p>
                <?php
                echo $this->Html->link(
                        $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-edit']) . ' ' . __('Edit'), ['controller' => 'LostItems', 'action' => 'edit', $lostitems->id], ['class' => 'btn btn-info', 'role' => 'button', 'escape' => false]
                );
                ?>
            </p> 

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= __('Item Details') ?></h3>
                </div>
                <div class="panel-body">
                    <table class="table vertical-table">
                    
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($lostitems->name) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Losting Date') ?></th>
                             <td><?= h($lostitems->lost_date) ?></td>                      
                        </tr>                            

                        <tr>
                            <th><?= __('country') ?></th>
                            <td><?= $lostitems->has('country') ? h($lostitems->country->name_en) : 'no' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Item Type') ?></th>
                            <td><?= $lostitems->has('item_type_id') ? h($lostitems->item_type->name) : '' ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($lostitems->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($lostitems->modified) ?></td>


                    </table>
                </div>
            </div>
        </div>

        <div class ='col-md-6'>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class ='col-md-4'>
                        <h1><?= h($nbApplicantSeekers) ?> <i class="fa fa-binoculars" aria-hidden="true"></i></h1>
                        <small><?= __('views') ?></small>
                    </div>
                    <div class ='col-md-4'>
                        <h1><?= h($nbApplicantAccepted) ?> <i class="fa fa-users" aria-hidden="true"></i></h1>
                        <small><?= __('Notifications and messages') ?></small>
                    </div>
         
     


                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Images</h3>
                </div>
                <div class="panel-body">
                        
                          <div class="upload-frm">
                          <?php echo $this->Form->create($uploadData, ['type' => 'file']); ?>
                          <?php echo $this->Form->input('file', ['type' => 'file', 'class' => 'form-control']); ?>
                          <?php echo $this->Form->button(__('Upload File'), ['type'=>'submit', 'class' => 'form-controlbtn btn-default']); ?>
                          <?php echo $this->Form->end(); ?>
                          </div>
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
                           
                            <?= h($lostitems->description) ?>
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

