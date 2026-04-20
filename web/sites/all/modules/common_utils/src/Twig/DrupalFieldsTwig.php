<?php

namespace Drupal\common_utils\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Drupal\Core\Field\FieldItemListInterface;

class DrupalFieldsTwig extends AbstractExtension {

  public function getName() {
    return 'drupal_fields_twig_php';
  }

  public function getFunctions() {
    return [
      new TwigFunction('select_list_label', [$this, 'getSelectListLabel']),
    ];
  }

  /**
   * @param FieldItemListInterface $field
   * @return string
   * 選択リストのラベルを取得する(twigだけでは簡単に取得できないので)
  */
  public function getSelectListLabel(FieldItemListInterface $field) {

    $value = $field->value;
    $allowed_values = $field->getFieldDefinition()->getSetting('allowed_values');

    return isset($allowed_values[$value]) ? $allowed_values[$value] : NULL;

  }

}
