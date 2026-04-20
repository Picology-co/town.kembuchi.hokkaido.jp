<?php

namespace Drupal\template_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'TemplateBlock' block.
 *
 * @Block(
 *   id = "template_block",
 *   admin_label = @Translation("Template Block"),
 *   category = @Translation("Custom")
 * )
 */
class TemplateBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // This is where you would typically return a render array.
    // For now, we will return a simple string.
    return [
      '#markup' => $this->t('This is a template block.'),
    ];
  }

public function getCacheMaxAge() {
    // キャッシュなしの場合は0
    return 0;
  }

}