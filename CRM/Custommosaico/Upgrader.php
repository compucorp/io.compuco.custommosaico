<?php

use CRM_Custommosaico_ExtensionUtil as E;
use CRM_Custommosaico_Plugin_FontLoader as FontLoaderPlugin;

/**
 * Collection of upgrade steps.
 */
class CRM_Custommosaico_Upgrader extends CRM_Custommosaico_Upgrader_Base {

  public function install() {
    $this->createOptionGroup(FontLoaderPlugin::OPTION_GROUP);
  }

  public function uninstall() {
    $this->deleteOptionGroup(FontLoaderPlugin::OPTION_GROUP);
  }

  public function onEnable() {
    $this->alterOptionGroup('enable', FontLoaderPlugin::OPTION_GROUP);
  }

  public function onDisable() {
    $this->alterOptionGroup('disable', FontLoaderPlugin::OPTION_GROUP);
  }

  /**
   * Alters option group
   *
   * @param $action
   * @param $name
   */
  private function alterOptionGroup($action, $name) {
    $optionGroupId = $this->getOptionGroupId($name);

    $alterOptionGroup = [];

    switch ($action) {
      case 'enable':
        $alterOptionGroup = [
          'option_group_id' => $optionGroupId,
          'api.OptionGroup.create' => [
            'id' => '$value.id',
            'is_active' => 1,
          ],
        ];
        break;

      case 'disable':
        $alterOptionGroup = [
          'option_group_id' => $optionGroupId,
          'api.OptionGroup.create' => [
            'id' => '$value.id',
            'is_active' => 0,
          ],
        ];
        break;

      case 'uninstall':
        $alterOptionGroup = [
          'option_group_id' => $optionGroupId,
          'api.OptionGroup.delete' => ['id' => '$value.id'],
        ];
        break;
    }

    civicrm_api3('OptionGroup', 'get', $alterOptionGroup);
  }

  private function getOptionGroupId($name) {
    try {
      $result = civicrm_api3('OptionGroup', 'getvalue', ['return' => 'id', 'name' => $name]);
      return $result;
    }
    catch (\CiviCRM_API3_Exception $ex) {
      return FALSE;
    }

  }

  public function createOptionGroup($name) {
    $optionGroupId = $this->getOptionGroupid($name);
    if (!empty($optionGroupId)) {
      return;
    }

    civicrm_api3('OptionGroup', 'create',
      [
        'name' => $name,
        'title' => E::ts('Brand Fonts'),
      ]);
  }

  public function deleteOptionGroup($name) {
    $optionGroupId = $this->getOptionGroupid($name);
    if (empty($optionGroupId)) {
      return;
    }

    $this->alterOptionGroup('uninstall', $name);
  }

}
