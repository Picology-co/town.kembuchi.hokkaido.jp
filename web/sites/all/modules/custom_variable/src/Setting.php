<?php

namespace Drupal\custom_variable;

class Setting {

  /**
   * 設定を新規追加する
   * @param array $setting_array key, value, detail
   */
  public function setCustomVariable(array $setting_array) {

    try {
      $query = \Drupal::database()->insert('custom_variable');
      $query->fields([
        'key' => $setting_array['key'],
        'value' => $setting_array['value'],
        'detail' => $setting_array['detail'],
        'created' => time(),
        'changed' => time(),
      ]);
      $query->execute();
    }
    catch(\Exception $e) {
      \Drupal::logger('donations_system')->error('[Query Error]setCustomVariable: ' . $e->getMessage() . ' | Query: ' . $query->__toString());
      return null;
    }
  }

  /**
   * 設定を取得する。
   * @param ?string $key
   * @return array
   */
  public function getCustomVariable(?string $key=NULL) {
    try {
      $query=\Drupal::database()->select('custom_variable', 'f');
      $query->addField('f', 'key', 'key');
      $query->addField('f', 'value', 'value');
      $query->addField('f', 'detail', 'detail');
      $query->addField('f', 'created', 'created');
      if (!empty($key)) {
        $query->condition('f.key', $key, '=');
      }

      $results = $query->execute()->fetchAll();
      return $results;
    }
    catch(\Exception $e) {
      \Drupal::logger('donations_system')->error('[Query Error]getCustomVariable: ' . $e->getMessage() . ' | Query: ' . $query->__toString());
      return null;
    }
  }

  /**
   * 設定を更新する。
   * @param array $setting_array key, value, detail, created
   */
  public function updateCustomVariable(array $setting_array) {
    try {
      $query = \Drupal::database()->update('custom_variable');
      $query->fields([
        'value' => $setting_array['value'],
        'detail' => $setting_array['detail'],
        'changed' => time(),
      ]);
      $query->condition('key', $setting_array['key'], '=');
      $query->execute();
    }
    catch(\Exception $e) {
      \Drupal::logger('donations_system')->error('[Query Error]updateCustomVariable: ' . $e->getMessage() . ' | Query: ' . $query->__toString());
      return null;
    }
  }
}