<?php

namespace Drupal\common_utils\Config;

class DrupalConfig {

  protected string $name;

  public function __construct(string $__name) {
    $this->name = $__name;
  }

  /**
   * Drupalの設定を取得する。
   * @param string $key
   * @return string
   */
  public function getConfig(string $key) {

    $config = \Drupal::config($this->name);
    return $config->get($key);

  }

  /**
   * Drupalの設定一覧を取得する。
   * @param ?string $stype : json/array
   * @return array
   */
  public static function ConfigList(?string $style='array') {

    $names = \Drupal::service('config.storage')->listAll();
    $config_array = [];
    foreach ($names as $name_row) {
      $config = \Drupal::config($name_row);

      if ($style === 'json') {
        $config_array[] = [
          'name' => $name_row,
          'data' => json_encode($config->getRawData()),
        ];
      }
      elseif ($style === 'array') {
        $config_array[] = [
          'name' => $name_row,
          'data' => $config->getRawData(),
        ];
      }
      else {
        // それ以外の時はarrayとみなす
        // 後から変更しやすいように分ける
        $config_array[] = [
          'name' => $name_row,
          'data' => $config->getRawData(),
        ];
      }
    }
    return $config_array;
  }
}