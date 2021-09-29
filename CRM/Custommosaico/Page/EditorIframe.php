<?php
use CRM_Custommosaico_ExtensionUtil as E;

class CRM_Custommosaico_Page_EditorIframe extends CRM_Mosaico_Page_Editor {

  public function run() {
    $cacheCode = CRM_Core_Resources::singleton()->getCacheCode();
    $smarty = CRM_Core_Smarty::singleton();
    $smarty->assign('pluginUrl', E::url("js/mosaico-plugins/index.js?c={$cacheCode}"));
    parent::run();
  }

}
