<?php

class CRM_Custommosaico_Plugin_ColorLoader {

  const OPTION_GROUP = 'custommosaico_brand_colors';

  public static function getPluginJS() {
    $colors = Civi::settings()->get('custommosaico_brand_selected_colors') ?? [];

    if (count($colors) < 1) {
      return "";
    }

    $customColors = [];
    foreach ($colors as $key => $value) {
      $customColors[] = '\\\'' . $value . '\\\'';
    }
    $customColors = '[' . implode(',', $customColors) . ']';

    $widget =
        <<< JS
        {
            widget: function ($, ko, kojqui) {
                return {
                    widget: 'color',
                    parameters: { param: true },
                    html: function (propAccessor, onfocusbinding, parameters) {
                      return '<input size="7" type="text" data-bind="colorpicker: { customTheme: $customColors, color: ' + propAccessor + ', defaultPalette: \'theme\' }, ' + ', ' + onfocusbinding + '" />';
                    }
                };
            }
        }
        JS;

    return $widget;
  }

}
