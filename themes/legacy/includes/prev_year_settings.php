<?php

function legacy_prev_year_settings_form_alter(&$form) {
  $form['prev_year_settings'] = array(
    '#type'          => 'details',
    '#title'         => t('Previous Year Settings'),
    '#group'         => 'legacy_theme_settings',
    '#description'   => t('Enter information about the previous iteration of the conference.'),
    '#weight'        => -3
  );
  $form['prev_year_settings']['prev_info'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Basic Information'),
  );
  $form['prev_year_settings']['prev_info']['prev_info_name'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Name'),
    '#default_value' => theme_get_setting('prev_info_name'),
    '#description'   => t('Name displayed on conference site, e.g., <i>ASCE Convention 2017</i>'),
    '#required'      => TRUE,
  );
  $form['prev_year_settings']['prev_info']['prev_info_theme'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Theme'),
    '#default_value' => theme_get_setting('prev_info_theme'),
    '#description'   => t('Conference theme or tagline, e.g., <i>Where Engineering Dreams are Born</i>'),
    '#required'      => TRUE,
  );
  $form['prev_year_settings']['prev_info']['prev_info_blurb'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Conference Blurb'),
    '#default_value' => theme_get_setting('prev_info_blurb'),
    '#description'   => t('Elevator pitch for the conference'),
  );
  $form['prev_year_settings']['prev_dates'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Dates'),
  );
  $form['prev_year_settings']['prev_dates']['prev_dates_start'] = array(
    '#type'          => 'date',
    '#title'         => t('Start Date'),
    '#default_value' => theme_get_setting('prev_dates_start'),
    '#required'      => TRUE,
  );
  $form['prev_year_settings']['prev_dates']['prev_dates_end'] = array(
    '#type'          => 'date',
    '#title'         => t('End Date'),
    '#default_value' => theme_get_setting('prev_dates_end'),
    '#required'      => TRUE,
  );
  $form['prev_year_settings']['prev_location'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Location'),
  );
  $form['prev_year_settings']['prev_location']['prev_location_display'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Display Name'),
    '#default_value' => theme_get_setting('prev_location_display'),
    '#description'   => t('Location displayed in footer, e.g., <i>Boston, MA</i>'),
  );
  $form['prev_year_settings']['prev_location']['prev_location_advisory'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Advisory Title'),
    '#default_value' => theme_get_setting('prev_location_advisory'),
    '#description'   => t('Accessible location name, e.g., <i>Boston, Massachusetts</i>'),
    '#required'      => TRUE,
  );
  $form['prev_year_settings']['prev_location']['prev_location_blurb'] = array(
    '#type'          => 'textarea',
    '#title'         => t('Location Blurb'),
    '#default_value' => theme_get_setting('prev_location_blurb'),
    '#description'   => t('Short promotion for the conference location'),
  );
}
