<?php

namespace Drupal\rangoform\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines HelloController class.
 */
class HelloController extends ControllerBase {

  public function content() {
  
    $element = array(
      '#markup' => 'Hello, world',
    );
    return $element;
  }
}