<?php

namespace Drupal\common_utils\DebugTools;

class DebugUtils {

  /**
   * デバッグ用メッセージを表示する
   * @param mixed $value
   */
  public static function debugMessage(mixed $value) {
    \Drupal::messenger()->addMessage('<pre>' . json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>', 'status');
  }

  /**
   * デバッグ用のログを出力する
   * @param mixed $value
   */
  public static function debugLog(mixed $value) {
    \Drupal::logger('debug_log')->info('<pre>' . json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . '</pre>');
  }

}