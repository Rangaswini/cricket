<?php

namespace Drupal\clock\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Defines a form that configures forms module settings.
 */
class SubmitDemoForm extends FormBase {



  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'submit_demo_settings';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['submit']=[
      '#type'=> 'submit',
      '#value'=> $this->t('Save'),
  ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
   }

}