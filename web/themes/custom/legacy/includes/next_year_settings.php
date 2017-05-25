<?php

function legacy_next_year_settings_form_alter(&$form) {
  $form['next_year_settings'] = array(
    '#type'          => 'details',
    '#title'         => t('Next Year Settings'),
    '#group'         => 'legacy_theme_settings',
    '#description'   => t('Enter information about the upcoming iteration of the conference.'),
    '#weight'        => -2
  );
  $form['next_year_settings']['next_info'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Basic Information'),
  );
  $form['next_year_settings']['next_info']['next_info_name'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Name'),
    '#default_value' => theme_get_setting('next_info_name'),
    '#description'   => t('Name displayed in header.'),
    '#required'      => TRUE,
  );
  $form['next_year_settings']['next_info']['next_info_theme'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Theme'),
    '#default_value' => theme_get_setting('next_info_theme'),
    '#description'   => t('Conference theme or tagline.'),
    '#required'      => TRUE,
  );
  $form['next_year_settings']['next_info']['next_info_blurb'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Conference Blurb'),
    '#default_value' => theme_get_setting('next_info_blurb'),
    '#description'   => t('Elevator pitch for the conference.'),
  );
  $form['next_year_settings']['next_dates'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Dates'),
  );
  $form['next_year_settings']['next_dates']['next_dates_start'] = array(
    '#type'          => 'date',
    '#title'         => t('Start Date'),
    '#default_value' => theme_get_setting('next_dates_start'),
    '#required'      => TRUE,
  );
  $form['next_year_settings']['next_dates']['next_dates_end'] = array(
    '#type'          => 'date',
    '#title'         => t('End Date'),
    '#default_value' => theme_get_setting('next_dates_end'),
    '#required'      => TRUE,
  );
  $form['next_year_settings']['next_location'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Location'),
  );
  $form['next_year_settings']['next_location']['next_location_display'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Display Name'),
    '#default_value' => theme_get_setting('next_location_display'),
    '#description'   => t('Location displayed in footer. e.g.: <i>Reston, VA</i>'),
  );
  $form['next_year_settings']['next_location']['next_location_advisory'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Advisory Title'),
    '#default_value' => theme_get_setting('next_location_advisory'),
    '#description'   => t('Accessible location name. e.g.: <i>Reston, Virginia</i>'),
    '#required'      => TRUE,
  );
  $form['next_year_settings']['next_location']['next_location_blurb'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Location Blurb'),
    '#default_value' => theme_get_setting('next_location_blurb'),
    '#description'   => t('Short promotion for the conference location.'),
  );
}
