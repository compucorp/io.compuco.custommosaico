<?php

require_once 'custommosaico.civix.php';

use CRM_Custommosaico_ExtensionUtil as E;
use CRM_Custommosaico_Plugin_FontLoader as FontLoaderPlugin;
use CRM_Custommosaico_Plugin_ColorLoader as ColorLoaderPlugin;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function custommosaico_civicrm_config(&$config) {
  _custommosaico_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function custommosaico_civicrm_install() {
  _custommosaico_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function custommosaico_civicrm_enable() {
  _custommosaico_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_mosaicoBaseTemplates().
 */
function custommosaico_civicrm_mosaicoBaseTemplates(&$templates) {
  // Add custom mail template for mosaico.
  $templates['custommosaico'] = [
    'name' => 'versafix-compuco',
    'title' => 'Versafix Compuco',
    'path' => E::url('packages/compuco/templates/versafix-compuco/template-versafix-compuco.html'),
    'thumbnail' => E::url('packages/compuco/templates/versafix-compuco/edres/_full.png'),
  ];
}

/**
 * Implements hook_civicrm_mosaicoPlugin().
 */
function custommosaico_civicrm_mosaicoPlugin(&$plugins) {
  $plugins[] = FontLoaderPlugin::getPluginJS();
  $plugins[] = ColorLoaderPlugin::getPluginJS();
}

/**
 * Implements hook_civicrm_mosaicoScritUrlsAlter().
 */
function custommosaico_civicrm_mosaicoScriptUrlsAlter(&$scriptUrls) {
  $scriptUrls[] = CRM_Core_Resources::singleton()->getUrl('io.compuco.custommosaico', 'js/colorpicker.js', '', TRUE);
}

/**
 * Implements hook_civicrm_mosaicoStyleUrlsAlter().
 */
function custommosaico_civicrm_mosaicoStyleUrlsAlter(&$styleUrls) {
  $styleUrls[] = CRM_Core_Resources::singleton()->getUrl('io.compuco.custommosaico', 'css/evol-colorpicker.css', TRUE);
}

/**
 * Implements hook_civicrm_alterMailContent().
 */
function custommosaico_civicrm_alterMailContent(&$content) {
  // Replace [fontLoader.style] token with @font-face declaration.
  if ($content['template_type'] === 'mosaico') {
    $css = FontLoaderPlugin::getPluginCSS();

    if (!empty($content['text'])) {
      $content['text'] = str_replace('[fontLoader.style]', $css, $content['text']);
    }

    if (!empty($content['html'])) {
      $content['html'] = str_replace('[fontLoader.style]', $css, $content['html']);
    }
  }
}
