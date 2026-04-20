<?php

namespace Drupal\copyright_block;

use Drupal\copyright_block\DbControl;

class TextControl {

  /**
   * コピーライトのテキストを生成する。
   *
   * @return string|null
   */
  public function CreateCopyrightText() {

    // DbControlのインスタンスを取得
    $dbControl = new DbControl();

    // Since（年）を取得
    $since = $dbControl->getSince();

    // 現在の年を取得
    $currentYear = date('Y');

    // サイト名
    $site_name = \Drupal::config('system.site')->get('name');

    // 出力フォーマットを取得
    $format = $dbControl->getFormat();

    // コピーライトのテキストを生成
    if ($since === $currentYear) {
      // 同じ年の場合
      return str_replace(['@year', '@sitename'], [$since, $site_name], $format);
    } else {
      // 異なる年の場合
      return str_replace(['@year', '@sitename'], [$since . '-' . $currentYear, $site_name], $format);
    }
  }
}