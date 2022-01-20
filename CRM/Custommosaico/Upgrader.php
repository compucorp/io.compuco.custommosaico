<?php

use CRM_Custommosaico_ExtensionUtil as E;
use CRM_Custommosaico_Plugin_FontLoader as FontLoaderPlugin;
use CRM_Custommosaico_Plugin_ColorLoader as ColorLoaderPlugin;

/**
 * Collection of upgrade steps.
 */
class CRM_Custommosaico_Upgrader extends CRM_Custommosaico_Upgrader_Base {

  public function install() {
    $this->createOptionGroup(FontLoaderPlugin::OPTION_GROUP, E::ts('Brand Fonts'));
    $this->createOptionGroup(ColorLoaderPlugin::OPTION_GROUP, E::ts('Brand Colours'));
    $this->addDefaultBrandColors();

    return TRUE;
  }

  public function uninstall() {
    $this->deleteOptionGroup(FontLoaderPlugin::OPTION_GROUP);
    $this->deleteOptionGroup(ColorLoaderPlugin::OPTION_GROUP);

    return TRUE;
  }

  public function onEnable() {
    $this->alterOptionGroup('enable', FontLoaderPlugin::OPTION_GROUP);
    $this->alterOptionGroup('enable', ColorLoaderPlugin::OPTION_GROUP);

    return TRUE;
  }

  public function onDisable() {
    $this->alterOptionGroup('disable', FontLoaderPlugin::OPTION_GROUP);
    $this->alterOptionGroup('disable', ColorLoaderPlugin::OPTION_GROUP);

    return TRUE;
  }

  public function upgrade_0001() {
    $this->createOptionGroup(ColorLoaderPlugin::OPTION_GROUP, E::ts('Brand Colours'));
    $this->addDefaultBrandColors();

    return TRUE;
  }

  private function addDefaultBrandColors() {
    $colors = [
      ['value' => '#000000', 'label' => 'black', 'name' => '#000000'],
      ['value' => '#ffffff', 'label' => 'white', 'name' => '#ffffff'],
      ['value' => '#eeece1', 'label' => 'grey', 'name' => '#eeece1'],
      ['value' => '#1f497d', 'label' => 'blue', 'name' => '#1f497d'],
      ['value' => '#4f81bd', 'label' => 'light blue', 'name' => '#4f81bd'],
      ['value' => '#c0504d', 'label' => 'red', 'name' => '#c0504d'],
      ['value' => '#9bbb59', 'label' => 'green', 'name' => '#9bbb59'],
      ['value' => '#8064a2', 'label' => 'purple', 'name' => '#8064a2'],
      ['value' => '#4bacc6', 'label' => 'blue/green', 'name' => '#4bacc6'],
      ['value' => '#f79646', 'label' => 'orange', 'name' => '#f79646'],
    ];

    array_walk($colors, function($value, $key) {
      $this->createOptionValue(ColorLoaderPlugin::OPTION_GROUP, $value);
    });

    Civi::settings()->set('custommosaico_brand_selected_colors', array_column($colors, 'value'));
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

  public function createOptionGroup($name, $title) {
    $optionGroupId = $this->getOptionGroupid($name);
    if (!empty($optionGroupId)) {
      return;
    }

    civicrm_api3('OptionGroup', 'create',
      [
        'name' => $name,
        'title' => $title,
      ]);
  }

  public function deleteOptionGroup($name) {
    $optionGroupId = $this->getOptionGroupid($name);
    if (empty($optionGroupId)) {
      return;
    }

    $this->alterOptionGroup('uninstall', $name);
  }

  private function createOptionValue($groupId, $option) {
    $result = civicrm_api3('OptionValue', 'create', [
      'option_group_id' => $groupId,
      'name' => $option['name'],
      'label' => $option['label'],
      'value' => $option['value'],
    ]);

    return $result['id'];
  }

}
