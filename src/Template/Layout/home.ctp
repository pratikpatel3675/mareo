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

?>

<!DOCTYPE html>
<html lang= <?= $_language ?>  dir= <?= $_languageDirection?> class="<?= $_languageDirection == 'rtl' ? 'rtl' : '' ?>">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.25">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?php
        echo $this->Html->meta('icon');
        echo $this->fetch('meta');
        echo $this->element('styles');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

</head>

<body>

    <?php
        echo $this->element('header'); 
        echo $this->fetch('content');    
        echo $this->element('footer');
    ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>

    <?= $this->Html->script('/plugins/bootstrap/js/bootstrap.min.js') ?>

    <?php
        if(isset($_showLoginMenu) && $_showLoginMenu == true){
            echo "<script> $('.bs-login-modal-lg').modal('show');  </script> ";
        }
    ?>

    <?= $this->fetch('scriptBottom') ?>

    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <?= $this->Html->script('/plugins/holder/js/holder.min') ?>


</body>
</html>
