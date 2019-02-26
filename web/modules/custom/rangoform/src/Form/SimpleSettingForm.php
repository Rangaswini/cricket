<?php

namespace Drupal\rangoform\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class SimpleSettingForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rangoform_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'rangoform.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('rangoform.settings');
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#default_value' => $config->get('first_name'),
    ];
    $form['last_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Last name'),
        '#default_value' => $config->get('last_name'),
      ];
      $form['choice'] = array(
          
        '#type' => 'radios',
        '#title' => t('select ur gender'),
        '#options' => array(
        t('Male'),
        t('Female'),
        )
        );
        $form['type_options'] = array(
            '#type' => 'value',
            '#value' => array('bcs' => t('BCS'),
                              'mcs' => t('MCS'),
                              'mca' => t('MCA'))
          );
          $form['type'] = array(
            '#title' => t('Qualification'),
            '#type' => 'select',
            //'#description' => "Qualification.",
            '#options' => $form['type_options']['#value'],
          );  
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->config('rangoform.settings')
      ->set('variable_name', $values)
      ->save();
    parent::submitForm($form, $form_state);
  }

}