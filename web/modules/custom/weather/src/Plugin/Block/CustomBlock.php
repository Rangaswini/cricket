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
// use Drupal\image\Entity\ImageStyle;

//use Drupal\weather\Services\WeatherService;
class CustomBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
 

  
public function blockForm($form, FormStateInterface $form_state) {
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
public function blockSubmit($form, FormStateInterface $form_state) {
  // Save our custom settings when the form is submitted.
  $this->setConfigurationValue('city', $form_state->getValue('city'));
  $this->setConfigurationValue('desc', $form_state->getValue('desc'));

  $image = $form_state->getValue('image');
   
        $file = File::load($image[0]);
        $file->setPermanent();
        $file->save();
      
    $this->setConfigurationValue('image', $form_state->getValue('image'));

  // $this->configuration['city'] = $formState->getValue('city');

  
}
public function build() {
  $config = $this->getConfiguration();
  //print_r($config);
  $city= isset($config['city']) ? $config['city'] : 'Mumbai';
  $desc= isset($config['desc']) ? $config['desc'] : '';

  // $city=$config['city'];
//return $city;



  $config1= \Drupal::config('weather.settings');
       
  $appid= $config1->get('app');
  $s=\Drupal::service('weather.weather_service');
  
  $servCall = $s->get_weather_data($city);
  $jsonObj = json_decode($servCall);
  // kint($jsonObj->main);
  // exit();
  // return $re;
  // print_r('hello '.$ress);
  // kint($jsonObj-);
  // exit();
 

//   $form['city'] = [
    
//     '#type' => 'textfield',
//     '#title' => $this->t('City Name:'),
//     '#value' =>$this->t((string) $city),
//   ];
  
//   $form['desc'] = [
    
//     '#type' => 'textfield',
//     '#title' => $this->t('Desription:'),
//     '#value' =>$this->t((string) $desc),
//   ];
//   $image = $this->config['image'];
// if (!empty($image[0])) {
//   if ($file = File::load($image[0])) {
//     $form['image'] = [
//       // '#theme' => 'image_style',
//       // '#style_name' => 'medium',
//       '#uri' => $file->getFileUri(),
//     ];
//   }
// }
//   $form['temp_min'] = [
    
//     '#type' => 'textfield',
//     '#title' => $this->t('Minimum Temp:'),
//     '#value' =>$this->t((string) $jsonObj->main->temp_min),
//   ];
//   $form['temp_max'] = [
    
//     '#type' => 'textfield',
//     '#title' => $this->t('Maximum Temp:'),
//     '#value' =>$this->t((string) $jsonObj->main->temp_max),
//   ];
//   $form['pressure'] = [
    
//     '#type' => 'textfield',
//     '#title' => $this->t('Pressure:'),
//     '#value' =>$this->t((string) $jsonObj->main->pressure),
//   ];
//   $form['humidity'] = [
    
//     '#type' => 'textfield',
//     '#title' => $this->t('Humidity:'),
//     '#value' =>$this->t((string) $jsonObj->main->humidity),
//   ];

   $image = $config['image'];
   $file = File::load($image[0]);
   $img=$file->getFileUri();


  return array(
    '#theme' => 'weather',
    '#city' => $city,
    '#image' => $img,
    '#description' => $desc,
    '#temp_min' => $jsonObj->main->temp_min, 
    '#temp_max' => $jsonObj->main->temp_max,
    '#pressure' => $jsonObj->main->pressure,
    '#humidity' => $jsonObj->main->humidity,
);


  // return array(
  //   '#markup' => $this->t('@city', array('@city'=> $city)),
  // );
  //return $form;
}


}