<?php

namespace Drupal\template_twig\Twig;

// Twig実装必要↓
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TemplateTwig extends AbstractExtension {

  public function getName() {
    return 'template_twig_php';
  }

  public function getFunctions() {
    return [
      new TwigFunction('template_twig', [$this, 'TemplateTwig']),
    ];
  }

  /**
   * サンプル
   *
   * @return null
   */
  public function TemplateTwig() {

    return null;

  }
}