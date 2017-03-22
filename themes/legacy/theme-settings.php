<?php
require_once dirname(__FILE__) . '/includes/current_year_settings.php';

function legacy_form_system_theme_settings_alter(&$form, &$form_state){
  $form['legacy_theme_settings'] = [
    '#type' => 'vertical_tabs',
    '#parents' => ['legacy_theme_settings'],
  ];

  $form['theme_settings']['#group'] = 'legacy_theme_settings';
  $form['favicon']['#group'] = 'legacy_theme_settings';
  legacy_current_year_settings_form_alter($form);
}
