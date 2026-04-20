<?php

namespace Drupal\common_utils\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ContentsTwig extends AbstractExtension {

  public function getName() {
    return 'content_twig_php';
  }

  public function getFunctions() {
    return [
      new TwigFunction('convert_to_hankaku', [$this, 'convertToHankaku']),
    ];
  }

  // 全角英数字記号を半角に変換する
  public function convertToHankaku(string $source_text) {

    return mb_convert_kana($source_text, 'rnsa', 'utf-8');

  }

}
