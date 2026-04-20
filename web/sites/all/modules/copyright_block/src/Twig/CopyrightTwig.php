<?php

namespace Drupal\copyright_block\Twig;

// Twig実装必要↓
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFunction;
use Drupal\copyright_block\TextControl;

class CopyrightTwig extends AbstractExtension implements GlobalsInterface {

  public function getName() {
    return 'copyright_twig_php';
  }

/*   public function getFunctions() {
    return [
      new TwigFunction('copyright', [$this, 'getCopyrightText']),
    ];
  } */

  public function getGlobals(): array {

    return [
      'copyright' => $this->getCopyrightText(),
    ];
  }

  /**
   * コピーライトのテキストを出力する。
   *
   * @return string
   */
  public function getCopyrightText() {

    // TextControlのインスタンスを取得
    $textControl = new TextControl();

    // コピーライトのテキストを生成
    $copyright_text = t($textControl->CreateCopyrightText());
    return $copyright_text;
  }
}