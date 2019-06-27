<?php

namespace Drupal\clock\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Logger\LoggerChannelFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a form that configures forms module settings.
 */
class BasicFormExample extends FormBase {

  protected $loggerFactory;

      public function __construct(LoggerChannelFactory $loggerFactory) {
        $this->loggerFactory = $loggerFactory->get('myform_data');
      }
        public static function create(ContainerInterface $container){
          return new static ($container->get('logger.factory'));
        }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rangoform_settings';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
  
    $form['choice'] = array(       
      '#type' => 'radios',
      '#title' => t('select time zone'),
      '#options' => array(
      t('EST'),
      t('UTA'),
      )
      );
    
    $form['submit']=[
      '#type'=> 'submit',
      '#value'=> $this->t('Save'),
  ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

    $choice=$form_state->getValue('choice');
    if(1 === preg_match('~[0-9]~', $choice)){
        $form_state->setErrorByName('choice', $this->t('only alphabets are allowed'));
    }
}
  public function submitForm(array &$form, FormStateInterface $form_state) {

   $this->loggerFactory->notice('Selected time zone :' . $form_state->getValue('choice') );
    $this->messenger()->addMessage($this->t('@fav_car', array('@fav_car' => $form_state->getValue('choice'))));

    }

}