<?php
if($this->request->session()->read('System.language.code')=="en_US")
{
    echo $this->Html->link(__('navbar_arabic'), ['controller' => 'app', 'action' => 'changeLanguage', "ar_JO"]);
}
else
{
    echo $this->Html->link(__('navbar_english'), ['controller' => 'app', 'action' => 'changeLanguage', "en_US"]);
}
?>
