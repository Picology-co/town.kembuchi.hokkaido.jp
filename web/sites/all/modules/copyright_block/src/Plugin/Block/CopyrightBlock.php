<?php

namespace Drupal\copyright_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\copyright_block\TextControl;

/**
 * Provides a 'CopyrightBlock' block.
 *
 * @Block(
 *   id = "copyright_block",
 *   admin_label = @Translation("Copyright Block"),
 *   category = @Translation("Block")
 * )
 */
class CopyrightBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $textControl = new TextControl();
    // コピーライトのテキストを生成
    $copyright_text = $textControl->CreateCopyrightText();

    return [
      '#markup' => $this->t($copyright_text),
    ];
  }

public function getCacheMaxAge() {
    // キャッシュなしの場合は0
    return 0;
  }

}