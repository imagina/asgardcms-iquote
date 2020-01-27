<?php
return [
  'allow_custom_package' => [
    'description' => 'iquote::iquotes.setting.allow_custom_package',
    'view' => 'checkbox',
    'translatable' => false,
  ],
  'pdf-header-text' => [
    'description' => 'iquote::iquotes.setting.pdf header text',
    'view' => 'wysiwyg',
    'translatable' => true,
  ],
  'pdf-footer-text' => [
    'description' => 'iquote::iquotes.setting.pdf footer text',
    'view' => 'wysiwyg',
    'translatable' => true,
  ],
  'currency-symbol' => [
    'description' => 'iquote::iquotes.setting.currency_symbol',
    'view' => 'text',
    'translatable' => true,
  ],
];
