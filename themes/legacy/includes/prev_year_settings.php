<?php

function legacy_prev_year_settings_form_alter(&$form) {
  $form['prev_year_settings'] = array(
      '#type' => 'details',
      '#title' => t('Past Year Settings'),
      '#group' => 'legacy_theme_settings',
      '#description' => t("Enter values for the current conference year."),
      '#weight' => 2
  );
  $form['prev_year_settings']['prev_conference_dates'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Past Conference Date'),
    '#default_value' => theme_get_setting('prev_conference_dates'),
    '#description'   => t("Enter date of conference. ex: <em>April 3-5</em>"),
  );
  $form['prev_year_settings']['prev_conference_location'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Past Conference Location'),
    '#default_value' => theme_get_setting('prev_conference_location'),
    '#description'   => t("Enter conference location. ex: <em>Boston, Massachusetts</em>"),
  );
  $form['prev_year_settings']['prev_conference_year'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Past Conference Year'),
    '#default_value' => theme_get_setting('prev_conference_year'),
    '#description'   => t("Enter year of conference. ex: <em>2016</em>"),
  );
}
