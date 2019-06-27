<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */

/**
 * Provides a custom block
 * 
 * @Block(
 *   id = "clock_est_custom_block",
 *   admin_label = @Translation("The est clock block"),
 *   category = @Translation("Blocks")
 * )
 */

namespace Drupal\clock\Plugin\Block;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

//use Drupal\weather\Services\WeatherService;
class EstBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */ 
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form=parent::blockForm($form, $form_state);
        $config = $this->getConfiguration();

        $form['choice'] = array(       
          '#type' => 'radios',
          '#title' => t('select time zone'),
          '#options' => array(
          t('EST'),
          t('UTC'),
          )
          );
          
          return $form;
    }
    public function blockSubmit($form, FormStateInterface $form_state)
    {
        // Save our custom settings when the form is submitted.
          $this->setConfigurationValue('choice', $form_state->getValue('choice'));
    }
    public function build()
    {
          $config = $this->getConfiguration();
          $zone= isset($config['choice']) ? $config['choice'] : 'est';
          $config1= \Drupal::config('clock.settings');
          $s=\Drupal::service('clock.clock_demo');
      
          $servCall = $s->getData($zone);
          $jsonObj = json_decode($servCall);
          

          return array(
        '#theme' => 'clock',
        '#zone' => $zone,
        '#currentDateTime' => $jsonObj->currentDateTime,
        '#utcOffset' => $jsonObj->utcOffset, 
        '#dayOfTheWeek' => $jsonObj->dayOfTheWeek,
        '#timeZoneName' => $jsonObj->timeZoneName,
        '#currentFileTime' => $jsonObj->currentFileTime,
          );

    }


}