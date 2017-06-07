<?php

function legacy_current_year_settings_form_alter(&$form) {
  $form['current_year_settings'] = array(
    '#type'          => 'details',
    '#title'         => t('Current Year Settings'),
    '#group'         => 'legacy_theme_settings',
    '#description'   => t('Enter information about the current conference.'),
    '#weight'        => -5
  );
  $form['current_year_settings']['current_info'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Basic Information'),
  );
  $form['current_year_settings']['current_info']['current_info_name'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Name'),
    '#default_value' => theme_get_setting('current_info_name'),
    '#description'   => t('Name displayed in header.'),
    '#required'      => TRUE,
  );
  $form['current_year_settings']['current_info']['current_info_theme'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Theme'),
    '#default_value' => theme_get_setting('current_info_theme'),
    '#description'   => t('Conference theme or tagline.'),
    '#required'      => TRUE,
  );
  $form['current_year_settings']['current_dates'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Dates'),
  );
  $form['current_year_settings']['current_dates']['current_dates_start'] = array(
    '#type'          => 'date',
    '#title'         => t('Start Date'),
    '#default_value' => theme_get_setting('current_dates_start'),
    '#required'      => TRUE,
  );
  $form['current_year_settings']['current_dates']['current_dates_end'] = array(
    '#type'          => 'date',
    '#title'         => t('End Date'),
    '#default_value' => theme_get_setting('current_dates_end'),
    '#required'      => TRUE,
  );
  $form['current_year_settings']['current_location'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Location'),
  );
  $form['current_year_settings']['current_location']['current_location_display'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Display Name'),
    '#default_value' => theme_get_setting('current_location_display'),
    '#description'   => t('Location displayed in header. e.g.: <i>Reston, VA</i>'),
    '#required'      => TRUE,
  );
  $form['current_year_settings']['current_location']['current_location_advisory'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Advisory Title'),
    '#default_value' => theme_get_setting('current_location_advisory'),
    '#description'   => t('Accessible location name. e.g.: <i>Reston, Virginia</i>'),
    '#required'      => TRUE,
  );
}
