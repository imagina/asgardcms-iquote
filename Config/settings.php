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
  'email-text' => [
    'description' => 'iquote::iquotes.setting.email text',
    'view' => 'wysiwyg',
    'translatable' => true,
  ],
  'currency-symbol' => [
    'description' => 'iquote::iquotes.setting.currency_symbol',
    'view' => 'text',
    'translatable' => true,
  ],
  'logo-header' => [
    'description' => 'iquote::iquotes.setting.logo_header',
    'view' => 'isite::admin.fields.file',
  ],
  'logo-footer1' => [
    'description' => 'iquote::iquotes.setting.logo_footer1',
    'view' => 'isite::admin.fields.file',
  ],
  'logo-footer2' => [
    'description' => 'iquote::iquotes.setting.logo_footer2',
    'view' => 'isite::admin.fields.file',
  ],
  'logo-footer3' => [
    'description' => 'iquote::iquotes.setting.logo_footer3',
    'view' => 'isite::admin.fields.file',
  ],
  'logo-footer4' => [
    'description' => 'iquote::iquotes.setting.logo_footer4',
    'view' => 'isite::admin.fields.file',
  ],
];
