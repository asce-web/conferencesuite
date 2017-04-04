<?php

function legacy_current_year_settings_form_alter(&$form) {
  $form['current_year_settings'] = array(
    '#type' => 'details',
    '#title' => t('Current year'),
    '#group' => 'legacy_theme_settings',
    '#weight' => -4
  );
  $form['current_year_settings']['current_info'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Basic Information'),
  );
  $form['current_year_settings']['current_info']['current_info_name'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Name'),
    '#default_value' => theme_get_setting('current_info_name'),
    '#description'   => t("ex: <em>ASCE Convention 2017</em>"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_info']['current_info_theme'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Theme'),
    '#default_value' => theme_get_setting('current_info_theme'),
    '#description'   => t("ex: <em>Where Engineering Dreams are Born</em>"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_info']['current_info_blurb'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Conference Blurb'),
    '#default_value' => theme_get_setting('current_info_blurb'),
  );
  $form['current_year_settings']['current_conference_dates'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Dates'),
  );
  $form['current_year_settings']['current_dates']['current_dates_start'] = array(
    '#type'          => 'date',
    '#title'         => t('Start Date'),
    '#default_value' => theme_get_setting('current_dates_start'),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_dates']['current_dates_end'] = array(
    '#type'          => 'date',
    '#title'         => t('End Date'),
    '#default_value' => theme_get_setting('current_dates_end'),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_location'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Location'),
  );
  $form['current_year_settings']['current_location']['current_location_display'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Display Name'),
    '#default_value' => theme_get_setting('current_location_display'),
    '#description'   => t("Location displayed throughout site. ex: <em>Boston, MA</em>"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_location']['current_location_advisory'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Advisory Title'),
    '#default_value' => theme_get_setting('current_location_advisory'),
    '#description'   => t("Expanded location. ex: <em>Boston, Massachusetts</em>"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_location']['current_location_blurb'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Location Blurb'),
    '#default_value' => theme_get_setting('current_location_blurb'),
  );
}
