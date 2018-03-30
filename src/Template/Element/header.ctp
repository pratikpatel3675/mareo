
<header>
	<div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-inverse navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <?= $this->Html->link(
                $_productName,
                ['controller' => 'Home', 'action' => 'index', '_full' => true],
                ['class' => 'navbar-brand']
                )
              ?>
              
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              
              <ul class="nav navbar-nav">
                <?php
                  foreach ($_mainMenu as $name => $attr) {
                    echo '<li>';
                    echo '<a href="' . $this->Url->build($attr['url']) . '">';
                    echo __($name);
                    echo '</a>';
                    echo '</li>';
                  }
                ?>
              </ul>

							<ul class="nav navbar-nav navbar-right">
        				<li><?php echo $this->element('language_bar'); ?></li>
								
                <?php
                if (!$_authUser)
                {
                  echo '<li>';
                  echo '<a data-toggle="modal" data-target=".bs-login-modal-lg">'.__('navbar_login').'</a>' ;
                  echo '</li>';
                }
                else
                {
                  echo $this->element('my_profile');
                }
                ?>
				      </ul>

            </div>
          </div>
        </nav>

      </div>
    </div>


<?php 
  // Load the modal login menu if no user is logged in
  if (!$_authUser)
  {
    echo $this->element('login_menu');
  }
?>


</header>
