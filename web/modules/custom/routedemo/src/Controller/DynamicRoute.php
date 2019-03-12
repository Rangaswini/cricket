<?php

namespace Drupal\routedemo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\user\UserInterface;
use Drupal\node\NodeInterface;

use Drupal\node\Entity\Node;

/**
 * Defines HelloController class.
 */
class DynamicRoute extends ControllerBase{

  public function hello() {
  
    $element = array(
      '#markup' => 'Hello',
    );
    return $element;
  }
  public function helloName($arg) {
  
    $element = [
      '#markup' => 'Hello, '.$arg,
    ];
    return $element;
  }
  public function authorname(NodeInterface $node){
    $author = $node->getOwner();
    $author_name = $author->getUsername();
    return array(
       '#type' => 'markup',
      '#markup' => t('Hello @author_name', array('@author_name' => $author_name)),
      );
    
  }
}