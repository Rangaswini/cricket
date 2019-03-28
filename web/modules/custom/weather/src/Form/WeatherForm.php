<?php

namespace Drupal\weather\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Defines a form that configures forms module settings.
 */
class WeatherForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'weather_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'weather.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
      $config = $this->config('weather.settings');
      $form['your_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Application Id'),
      '#default_value' => $config->get('app'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      $values = $form_state->getValues();
      $this->config('weather.settings')
        ->set('app', $values)
        ->save();
      parent::submitForm($form, $form_state);  
  }

}