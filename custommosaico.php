<?php

require_once 'custommosaico.civix.php';

use CRM_Custommosaico_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function custommosaico_civicrm_config(&$config) {
  _custommosaico_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function custommosaico_civicrm_xmlMenu(&$files) {
  _custommosaico_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function custommosaico_civicrm_postInstall() {
  _custommosaico_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function custommosaico_civicrm_uninstall() {
  _custommosaico_civix_civicrm_uninstall();
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
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function custommosaico_civicrm_disable() {
  _custommosaico_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function custommosaico_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _custommosaico_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function custommosaico_civicrm_managed(&$entities) {
  _custommosaico_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function custommosaico_civicrm_caseTypes(&$caseTypes) {
  _custommosaico_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function custommosaico_civicrm_angularModules(&$angularModules) {
  _custommosaico_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function custommosaico_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _custommosaico_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function custommosaico_civicrm_entityTypes(&$entityTypes) {
  _custommosaico_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_themes().
 */
function custommosaico_civicrm_themes(&$themes) {
  _custommosaico_civix_civicrm_themes($themes);
}

/**
 * Implements hook_civicrm_mosaicoBaseTemplates().
 */
function custommosaico_civicrm_mosaicoBaseTemplates(&$templates) {
  // Add custom mail template for mosaico.
  $templates['custommosaico'] = [
    'name' => 'versafix-compucorp',
    'title' => 'Versafix Compucorp',
    'path' => E::url('packages/compucorp/templates/versafix-compucorp/template-versafix-compucorp.html'),
    'thumbnail' => E::url('packages/compucorp/templates/versafix-compucorp/edres/_full.png'),
  ];
}