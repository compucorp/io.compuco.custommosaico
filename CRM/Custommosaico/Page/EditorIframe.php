<?php

class CRM_Custommosaico_Page_EditorIframe extends CRM_Mosaico_Page_Editor {

  public function run() {
    $smarty = CRM_Core_Smarty::singleton();
    $plugins = [];

    // Allow plugins to be added by a hook
    if (class_exists('\Civi\Core\Event\GenericHookEvent')) {
      \Civi::dispatcher()->dispatch('hook_civicrm_mosaicoPlugin',
        \Civi\Core\Event\GenericHookEvent::create([
          'plugins' => &$plugins,
        ])
      );
    }

    $smarty->assign('mosaicoPlugins', '[ ' . implode( ',', $plugins ) . ' ]');
    parent::run();
  }

}
