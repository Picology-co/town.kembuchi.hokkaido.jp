<?php

namespace Drupal\custom_variable\Twig;

// Twig実装必要↓
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Drupal\custom_variable\Setting;

class Parameter extends AbstractExtension {

  public function getFunctions() {
    return [
      new TwigFunction('custom_variable', [$this, 'getCustomVariable']),
    ];
  }

  /**
   * カスタム変数を取得する
   * @param string $key
   * @return null
   */
  public function getCustomVariable(string $key) {

    $setting = new Setting();
    $value = $setting->getCustomVariable($key)[0]->value;
    return $value;
  }
}