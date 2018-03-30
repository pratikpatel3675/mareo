<?php

 echo $this->Html->css('/plugins/bootstrap/css/bootstrap');
 echo $this->Html->css('/plugins/bootstrap/css/bootstrap-theme');
 echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min');

 ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
	<?php
	  echo $this->Html->css('/css/carousel.css');
    echo $this->Html->css('/css/jami3ti.css');

		if ($_languageDirection == 'rtl') {
      echo $this->Html->css('bootstrap-rtl');
			echo $this->Html->css('bootstrap-flipped');
		}

	?>
