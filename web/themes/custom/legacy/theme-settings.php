<?php

function legacy_form_system_theme_settings_alter(&$form, &$form_state){
  $form['legacy_theme_settings'] = [
    '#type' => 'vertical_tabs',
    '#parents' => ['legacy_theme_settings'],
  ];

  $form['theme_settings']['#group'] = 'legacy_theme_settings';

  $form['conference_settings'] = array(
    '#type'          => 'details',
    '#title'         => t('Conference Information'),
    '#group'         => 'legacy_theme_settings',
    '#description'   => t('Enter information about the current conference.'),
    '#weight'        => -5
  );
  $form['conference_settings']['conference_info'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Basic Information'),
  );
  $form['conference_settings']['conference_info']['conference_info_name'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Name'),
    '#default_value' => theme_get_setting('conference_info_name'),
    '#description'   => t('Name displayed in header.'),
    '#required'      => TRUE,
  );
  $form['conference_settings']['conference_info']['conference_info_theme'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Conference Theme'),
    '#default_value' => theme_get_setting('conference_info_theme'),
    '#description'   => t('Conference theme or tagline.'),
    '#required'      => TRUE,
  );
  $form['conference_settings']['conference_dates'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Dates'),
  );
  $form['conference_settings']['conference_dates']['conference_dates_start'] = array(
    '#type'          => 'date',
    '#title'         => t('Start Date'),
    '#default_value' => theme_get_setting('conference_dates_start'),
    '#required'      => TRUE,
  );
  $form['conference_settings']['conference_dates']['conference_dates_end'] = array(
    '#type'          => 'date',
    '#title'         => t('End Date'),
    '#default_value' => theme_get_setting('conference_dates_end'),
    '#required'      => TRUE,
  );
  $form['conference_settings']['conference_location'] = array(
    '#type'          => 'fieldset',
    '#title'         => t('Location'),
  );
  $form['conference_settings']['conference_location']['conference_location_display'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Display Name'),
    '#default_value' => theme_get_setting('conference_location_display'),
    '#description'   => t('Location displayed in header.'),
    '#required'      => TRUE,
  );
  $form['conference_settings']['conference_location']['conference_location_advisory'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Advisory Title'),
    '#default_value' => theme_get_setting('conference_location_advisory'),
    '#description'   => t('Accessible location name.'),
    '#required'      => TRUE,
  );
  // $form['favicon']['#group'] = 'legacy_theme_settings';
}
