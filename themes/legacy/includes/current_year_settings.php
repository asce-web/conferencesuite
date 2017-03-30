<?php

function legacy_current_year_settings_form_alter(&$form) {
  $form['current_year_settings'] = array(
      '#type' => 'details',
      '#title' => t('Current year'),
      '#group' => 'legacy_theme_settings',
      '#weight' => 1
  );
  $form['current_year_settings']['current_conference_info'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Basic Information'),
  );
  $form['current_year_settings']['current_conference_info']['current_conference_name'] = array(
    '#type'         => 'textfield',
    '#title'         => t('Conference Name'),
    '#default_value' => theme_get_setting('current_conference_name'),
    '#description'   => t("ex: <em>ASCE Convention 2017</em>"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_conference_dates'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Dates'),
  );
  $form['current_year_settings']['current_conference_dates']['current_conference_start_date'] = array(
    '#type'          => 'date',
    '#title'         => t('Start Date'),
    '#default_value' => theme_get_setting('current_conference_start_date'),
    '#description'   => t("Select conference start date"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_conference_dates']['current_conference_end_date'] = array(
    '#type'          => 'date',
    '#title'         => t('End Date'),
    '#default_value' => theme_get_setting('current_conference_end_date'),
    '#description'   => t("Select conference end date"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_conference_location'] = array(
    '#type'         => 'fieldset',
    '#title'        => t('Location'),
  );
  $form['current_year_settings']['current_conference_location']['current_display_location'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Display Name'),
    '#default_value' => theme_get_setting('current_display_location'),
    '#description'   => t("Enter conference location. ex: <em>Boston, Massachusetts</em>"),
    '#required' => TRUE,
  );
  $form['current_year_settings']['current_conference_location']['current_advisory_location'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Advisory Title'),
    '#default_value' => theme_get_setting('current_advisory_location'),
    '#description'   => t("Enter conference location. ex: <em>Boston, MA</em>"),
  );

  // image upload field
  // $config = \Drupal::getContainer()->get('config.factory')->getEditable('advtour_ui.settings');
  // $config->set('intermedia','thumbnail')->save();

  $form['current_year_settings']['current_conference_location']['location_image'] = array(
    '#title' => t('Location Image'),
  	'#type' => 'managed_file',
  	'#prefix'	=> 'Dummy prefix',
  	'#suffix'	=> 'Dummy suffix',
  	'#description' => t('Although the uploaded image will be displayed on this page fill in alternative text.'),
  	'#default_value' => theme_get_setting('location_image'),
  	'#upload_validators'  => array(
  		'file_validate_extensions' => array('gif png jpg jpeg'),
  		'file_validate_size' => array(25600000),
  	),
  	'#upload_location' => 'public://theme-settings/location-image/',
  	'#required' => TRUE,
  );
}
