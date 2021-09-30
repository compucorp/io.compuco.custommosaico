<?php
use CRM_Custommosaico_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Custommosaico_Upgrader extends CRM_Custommosaico_Upgrader_Base {

  public function install() {
    // Create the custommosaico_brand_fonts option group.
    civicrm_api3('OptionGroup', 'create', ['name' => 'custommosaico_brand_fonts', 'title' => E::ts('Brand Fonts')]);
  }

  public function uninstall() {
    // Delete custommosaico_brand_fonts option group and its values.
    try {
      $optionGroupId = civicrm_api3('OptionGroup', 'getvalue', ['return' => 'id', 'name' => 'custommosaico_brand_fonts']);
      $optionValues = civicrm_api3('OptionValue', 'get', ['option_group_id' => $optionGroupId, 'options' => ['limit' => 0]]);
      foreach ($optionValues['values'] as $optionValue) {
        civicrm_api3('OptionValue', 'delete', ['id' => $optionValue['id']]);
      }
      civicrm_api3('OptionGroup', 'delete', ['id' => $optionGroupId]);
    }
    catch (\CiviCRM_API3_Exception $ex) {
      // Ignore exception.
    }
  }

}
