<?php

namespace Drupal\rangoform\Form;

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
    
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter First name'),
      
    ];
    $form['last_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Last name'),
       
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
    $form['submit']=[
      '#type'=> 'submit',
      '#value'=> $this->t('Save'),
  ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

    $name=$form_state->getValue('first_name');
    if(1 === preg_match('~[0-9]~', $name)){
        $form_state->setErrorByName('name', $this->t('only alphabets are allowed'));
    }
}
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //drupal_set_message($this->t('Hi @fav_car', array('@fav_car' => $form_state->getValue('first_name').' '.$form_state->getValue('last_name'))));
    //$this->messenger()->addMessage($this->t('Hello world.'));
//$msg=$form_state->getValue('first_name');
   // \Drupal::logger('rangoForm')->notice($msg);
   $this->loggerFactory->notice('First  name :' . $form_state->getValue('first_name') . '  Last name :' . $form_state->getValue('last_name') . '<br>candidate_gender :' );
    $this->messenger()->addMessage($this->t('Hi @fav_car', array('@fav_car' => $form_state->getValue('first_name').' '.$form_state->getValue('last_name'))));

    }

}