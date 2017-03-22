<?php

function legacy_current_year_settings_form_alter(&$form) {
  $form['current_year_settings'] = array(
      '#type' => 'details',
      '#title' => t('Current Year Settings'),
      '#group' => 'legacy_theme_settings',
      '#description' => t("Enter values for the current conference year."),
      '#weight' => 1
  );
  $form['current_year_settings']['conference_dates'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Date'),
    '#default_value' => theme_get_setting('conference_dates'),
    '#description'   => t("Enter date of conference. ex: <em>April 3-5</em>"),
  );
  $form['current_year_settings']['conference_location'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Location'),
    '#default_value' => theme_get_setting('conference_location'),
    '#description'   => t("Enter conference location. ex: <em>Boston, Massachusetts</em>"),
  );
  $form['current_year_settings']['conference_year'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Year'),
    '#default_value' => theme_get_setting('conference_year'),
    '#description'   => t("Enter year of conference. ex: <em>2016</em>"),
  );
}
