
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

$this->layout = 'default_white';

if (!Configure::read('debug')):
    throw new NotFoundException();
endif;

?>

<div style="position: absolute; left: 0px; top: 0px; z-index: -1; width: 100%; height: 330px;" tabindex="0">
    <img class="featurette-image img-responsive" src="/img/banner_opportunity.jpg" alt="Generic placeholder image">
</div>


<div class="faqs index large-9 medium-8 columns content">
    <h2><?= __('Faqs') ?></h2>
    <div style="width: 20%;float: right">   
 <?php
echo $this->Form->create(null, ['url' => ['controller' => 'faqs', 'action' => 'index'], 'id' => 'countryForm']);
echo $this->Form->input('country_id', ['options' => $countries, 'default'=>'0' ,'label' => false]);
echo $this->Form->end();
?>
        </div>
    <table class= "table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('question') ?></th>
                <th><?= $this->Paginator->sort('answer') ?></th>
                <th><?= $this->Paginator->sort('country') ?></th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (count($faqs) > 0) {
                foreach ($faqs as $faq):
                    ?>
                    <tr>
                        <td align="justify"> <?= h($faq->question) ?></td></p>
                        <td align="justify"> <?= h($faq->answer) ?></td>
                        <td><?= isset($faq->country->name_en) ? h($faq->country->name_en) : 'NA' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php }else { ?> 
                <tr><td colspan="3"><center> <?php echo "No Record(s) found."; ?></center> </td></tr>
        <?php } ?>
        </tbody>
    </table>

</div>
<script>
    jQuery('#country-id').change(function(){
        jQuery('#countryForm').submit();
    });
</script>
