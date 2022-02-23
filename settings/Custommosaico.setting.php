<?php
use CRM_Mosaico_ExtensionUtil as E;

return [
  'custommosaico_brand_selected_fonts' => [
    'name' => 'custommosaico_brand_selected_fonts',
    'type' => 'Array',
    'is_domain' => 1,
    'description' => E::ts('Names of custom fonts to be used in mosaico editor'),
    'default' => [],
    'title' => E::ts('Brand Fonts'),
    'is_help' => TRUE,
    'help' => ["id" => "custommosaico_brand_fonts_select", "file" => "CRM/Custommosaico/Form/Settings"],
    'html_attributes' => [
      'class' => 'crm-select2 huge',
      'data-option-edit-path' => 'civicrm/admin/options/custommosaico_brand_fonts',
      'multiple' => 1,
    ],
    'html_type' => 'select',
    'settings_pages' => ['mosaico' => ['weight' => 150]],
    'pseudoconstant' => ['optionGroupName' => 'custommosaico_brand_fonts'],
  ],
  'custommosaico_brand_selected_colors' => [
    'name' => 'custommosaico_brand_selected_colors',
    'type' => 'Array',
    'is_domain' => 1,
    'description' => E::ts('Organisation brand colours'),
    'default' => [],
    'title' => E::ts('Brand Colours'),
    'is_help' => TRUE,
    'help' => ["id" => "custommosaico_brand_colors_select", "file" => "CRM/Custommosaico/Form/Settings"],
    'html_attributes' => [
      'class' => 'crm-select2 huge',
      'data-option-edit-path' => 'civicrm/admin/options/custommosaico_brand_colors',
      'multiple' => 1,
    ],
    'html_type' => 'select',
    'settings_pages' => ['mosaico' => ['weight' => 151]],
    'pseudoconstant' => ['optionGroupName' => 'custommosaico_brand_colors'],
  ],
  'custommosaico_brand_use_selected_colors' => [
    'name' => 'custommosaico_brand_use_selected_colors',
    'type' => 'Boolean',
    'default' => FALSE,
    'html_type' => 'checkbox',
    'is_domain' => 1,
    'title' => E::ts('Use the selected brand colours in Mosaico editor.'),
    'description' => ts('If enabled, Mosaico editor will display the selected brand colours in the colour picker.'),
    'settings_pages' => ['mosaico' => ['weight' => 152]],
  ],
];
