<div class="modal fade bs-login-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= __('login_title')  ?></h4>
      </div>

      <div class="modal-body">
      	<?php 
      	echo $this->Flash->render();
      	echo $this->Form->create(null, [
    		    'url' => ['controller' => 'Users', 'action' => 'login']
          ]);
		    echo $this->Form->input('email');
        echo $this->Form->input('password');

        echo '<p>';
        echo $this->Html->link(__('login_forgot_password'), ['controller' => 'Users', 'action' => 'resetPassword']);
        echo '<br>';
        echo $this->Html->link(__('login_not_registered'), ['controller' => 'Users', 'action' => 'register']);
        echo '</p>';

        ?>		

		  </div>

		  <div class="modal-footer">
  			<button type="button" class="btn btn-default" data-dismiss="modal"><?= __('btn_cancel')  ?></button>
        <?= $this->Form->button(__('btn_login'), ['type' => 'submit', 'class' => 'btn-primary']) ?>
        <?= $this->Form->end() ?>
      </div>
      
    </div>
  </div>
</div>