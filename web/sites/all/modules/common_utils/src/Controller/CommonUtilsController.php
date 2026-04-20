<?php

namespace Drupal\common_utils\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use DateTime;
use DateTimeZone;
use Drupal\common_utils\Config\DrupalConfig;
use Drupal\common_utils\DebugTools\DebugUtils;

class CommonUtilsController extends ControllerBase {

  /**
   * Drupalの設定リストをレンダリングする。
   */
  public function renderDrupalConfig() {

    $form = $this->formBuilder()->getForm('Drupal\common_utils\Form\DrupalConfigForm');
    $request = \Drupal::request();
    $style = $request->query->get('style');
    $filter_text = $request->query->get('filter_text');

    $config_list = DrupalConfig::ConfigList($style);
    if (isset($filter_text)) {
      // フィルタがセットされている
      $esc_filter_text = preg_quote($filter_text, '/');
      $name_list = array_keys(DrupalConfig::ConfigList());
      $data = array_filter($config_list, function($value) use ($esc_filter_text) {
        return preg_match("/{$esc_filter_text}/", $value['name']);
      });
    }
    else {
      $data = $config_list;
    }

    return [
      '#theme' => 'drupal_config', # .moduleの一意名
      '#form' => $form,
      '#data' => $data,
      '#style' => $style,
      '#filter_text' => $filter_text,
    ];
  }
}