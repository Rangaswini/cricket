<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\XaiBlock.
 */
/**
 * Provides a walker block
 * 
 * @Block(
 *   id = "walker",
 *   admin_label = @Translation("The walker block"),
 *   category = @Translation("Blocks")
 * )
 */

namespace Drupal\article\Plugin\Block;
use Drupal\Core\Block\BlockBase;
class CustomBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => 'This block list the article.',
    );
  }
}