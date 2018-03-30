
<ul class="nav nav-tabs">
  <?php
  foreach ($MenuItems as $name => $attr) {
      echo '<li role="presentation" class="' . $attr['class'] . '" >';
      echo '<a href="' . $this->Url->build($attr['url']) . '">';
      echo __($name);
      echo '</a>';
      echo '</li>';
  }
  ?>
</ul>
<p></p>