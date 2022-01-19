<?php

class CRM_Custommosaico_Page_EditorIframe extends CRM_Mosaico_Page_Editor {

  public function run() {
    $smarty = CRM_Core_Smarty::singleton();
    $plugins = [];

    // Allow plugins to be added by a hook.
    if (class_exists('\Civi\Core\Event\GenericHookEvent')) {
      \Civi::dispatcher()->dispatch('hook_civicrm_mosaicoPlugin',
        \Civi\Core\Event\GenericHookEvent::create([
          'plugins' => &$plugins,
        ])
      );
    }

    $smarty->assign('mosaicoPlugins', '[ ' . implode(',', $plugins) . ' ]');
    parent::run();
  }

  /**
   * Modify return value of parent:: method.
   */
  protected function getScriptUrls() {
    $scriptUrls = parent::getScriptUrls();

    CRM_Utils_Hook::singleton()->invoke(['scriptUrls'], $scriptUrls, $null, $null,
      $null, $null, $null,
      'civicrm_mosaicoScriptUrlsAlter'
    );
    return $scriptUrls;
  }

  /**
   * Modify return value of parent:: method.
   */
  protected function getStyleUrls() {
    $styleUrls = parent::getStyleUrls();

    CRM_Utils_Hook::singleton()->invoke(['styleUrls'], $styleUrls, $null, $null,
      $null, $null, $null,
      'civicrm_mosaicoStyleUrlsAlter'
    );
    return $styleUrls;
  }

}
