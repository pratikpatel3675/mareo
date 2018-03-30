
<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= __('navbar_my_profile')?><span class="caret"></span></a>
	<ul class="dropdown-menu">

				<?php
				foreach ($_myProfileMenu as $name => $attr) {
					if ($name != '_divider') {
						echo '<li>';
						echo '<a href="' . $this->Url->build($attr['url']) . '">';
						echo '<i class="fa ' . $attr['icon'] . '"></i>';
						echo '<span> ' . __($name) . '</span>';
						echo '</a>';
						echo '</li>';
					} else {
						echo '<li class="divider"></li>';
					}
				}
				?>

  
  </ul>
</li>


