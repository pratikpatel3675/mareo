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

?>

 
       
<h3><?= __('My Questions') ?></h3>




        
        
    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="col-md-3"><?= __('Question') ?></th>
                    <th class="col-md-3"><?= __('Answer') ?></th>
                <th class="col-md-1">  <?= __('Status') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqs as $faq): ?>
                <tr>
                    <td><?= $_language == 'en_US' ? h($faq->question_en) : h($faq->question_ara) ?></td>
                    <td> <?php echo $_language == 'en_US' ? h($faq->answer_en) : h($faq->answer_ara) ?></td>
                       <td class="actions">
                <?= 
                    ($faq->is_active == 0) ? h(__('Under Review')) : h(__('Published'));
                ?>
                </td>
                </tr>
                <?php endforeach; ?>
               <?php echo $this->Html->link(
            $this->Html->tag('span','',['class' => 'glyphicon glyphicon-plus']).' ' . __('Add Question'),
            ['controller' => 'Faqs', 'action' => 'add'],
            ['class' => 'btn btn-info', 'role' => 'button' , 'escape' => false]
            );
        ?>




            </tbody>  

        </table>                   
           
                     
                  