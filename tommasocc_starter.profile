<?php

/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter().
 */
function tommasocc_starter_form_install_configure_form_alter(&$form, FormStateInterface $form_state, $form_id) {
  $form['admin_account']['account']['mail']['#value'] = 'webservice@tommaso.cc';
  $form['admin_account']['account']['name']['#value'] = 'tommaso';
  $form['regional_settings']['site_default_country']['#value'] = 'US';
  $form['site_information']['site_mail']['#value'] = 'webservice@tommaso.cc';
  $form['update_notifications']['enable_update_status_module']['#value'] = 1;
  $form['update_notifications']['enable_update_status_emails']['#value'] = 0;
  // dd($form);
  // exit;
  // Add tommasocc Settings
  $form['tommasocc_container'] = [
    '#type' => 'fieldset',
    '#title' => t('tommasocc Settings'),
    '#open' => TRUE,
    '#description' => t('Select custom tommasocc modules to be installed.'),
    '#description_display' => 'before',
    '#weight' => 0,
    '#attributes' => [
      'class' => [
        'fieldgroup',
      ]
      ],
    'tommasocc_modules' => [
      '#type' => 'checkboxes',
      '#options' => [
        'tommasocc_announcements' => t('tommasocc Announcements'),
        'tommasocc_article' => t('tommasocc Article'),
        'tommasocc_event' => t('tommasocc Event'),
        'tommasocc_news' => t('tommasocc News'),
        'tommasocc_photo_album' => t('tommasocc Photo Album'),
        'tommasocc_search' => t('tommasocc Search'),
      ],
      '#title' => t('Select modules to install:'),
    ],
  ];
  $form['#submit'][] = 'tommasocc_starter_config_install_modules';
}

function tommasocc_starter_config_install_modules($form, FormStateInterface $form_state) {
  $modules = $form_state->getValue('tommasocc_modules');
  $modules = array_filter($modules, fn($value) => $value != 0);
  if (count($modules) > 0) {
    $installer = \Drupal::service('module_installer');
    $installer->install(array_keys($modules));
  }
}
