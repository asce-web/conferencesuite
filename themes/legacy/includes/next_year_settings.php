<?php

function legacy_next_year_settings_form_alter(&$form) {
  $form['next_year_settings'] = array(
      '#type' => 'details',
      '#title' => t('Next Year Settings'),
      '#group' => 'legacy_theme_settings',
      '#description' => t("Enter values for the next conference year."),
      '#weight' => 3
  );
  $form['next_year_settings']['next_conference_dates'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Next Conference Date'),
    '#default_value' => theme_get_setting('next_conference_dates'),
    '#description'   => t("Enter date of conference. ex: <em>April 3-5</em>"),
  );
  $form['next_year_settings']['next_conference_location'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Next Conference Location'),
    '#default_value' => theme_get_setting('next_conference_location'),
    '#description'   => t("Enter conference location. ex: <em>Boston, Massachusetts</em>"),
  );
  $form['next_year_settings']['next_conference_year'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Next Conference Year'),
    '#default_value' => theme_get_setting('next_conference_year'),
    '#description'   => t("Enter year of conference. ex: <em>2018</em>"),
  );
}
