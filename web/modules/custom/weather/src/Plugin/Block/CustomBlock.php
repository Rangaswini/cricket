<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */

/**
 * Provides a custom block
 * 
 * @Block(
 *   id = "weather_custom_block",
 *   admin_label = @Translation("The weather block"),
 *   category = @Translation("Blocks")
 * )
 */

namespace Drupal\weather\Plugin\Block;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

//use Drupal\weather\Services\WeatherService;
class CustomBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */ 
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form=parent::blockForm($form, $form_state);
        $config = $this->getConfiguration();

          $form['city'] = array(
        '#type' => 'textfield',
        '#title' => t('City Name:'),
          );
          $form['desc'] = array(
            '#type' => 'textfield',
            '#title' => t('Description:'),
        
          );
          $form['image'] = array(
            '#type' => 'managed_file',
            '#upload_location' => 'public://upload/hello',
            '#title' => t('Image'),
            '#upload_validators' => [
            'file_validate_extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            '#default_value' => isset($this->configuration['image']) ? $this->configuration['image'] : '',
            '#description' => t('The image to display'),
            '#required' => true
          );
          return $form;
    }
    public function blockSubmit($form, FormStateInterface $form_state)
    {
        // Save our custom settings when the form is submitted.
          $this->setConfigurationValue('city', $form_state->getValue('city'));
          $this->setConfigurationValue('desc', $form_state->getValue('desc'));
          $image = $form_state->getValue('image');
          $file = File::load($image[0]);
          $file->setPermanent();
          $file->save();
          $this->setConfigurationValue('image', $form_state->getValue('image'));
    }
    public function build()
    {
          $config = $this->getConfiguration();
          $city= isset($config['city']) ? $config['city'] : 'Mumbai';
          $desc= isset($config['desc']) ? $config['desc'] : '';
          $config1= \Drupal::config('weather.settings');
          
          $appid= $config1->get('app');
          $s=\Drupal::service('weather.weather_service');
      
          $servCall = $s->getWeatherData($city);
          $jsonObj = json_decode($servCall);
    

          $image = $config['image'];
          $file = File::load($image[0]);
          $img=$file->getFileUri();
          $round_min_temp=round($jsonObj->main->temp_min);
          $round_max_temp=round($jsonObj->main->temp_max);

          return array(
        '#theme' => 'weather',
        '#city' => $city,
        '#image' => $img,
        '#description' => $desc,
        '#temp_min' => $round_min_temp, 
        '#temp_max' => $round_max_temp,
        '#pressure' => $jsonObj->main->pressure,
        '#humidity' => $jsonObj->main->humidity,
          );

    }


}