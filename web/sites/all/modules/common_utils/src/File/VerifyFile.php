<?php

namespace Drupal\common_utils\File;

class VerifyFile {

  /**
   * ZIPファイルのマジックバイト（シグネチャ）をチェックする
   * @param string $file_path ファイルの絶対パス
   * @return bool 正常なZIPファイルなら TRUE、それ以外は FALSE
   */
  public function isValidZipFile($file_path) {
    $handle = fopen($file_path, 'rb');
    if ($handle === FALSE) {
      return FALSE;
    }

    $signature = fread($handle, 4);
    fclose($handle);

    // ZIPファイルのシグネチャは "50 4B 03 04"
    return $signature === "\x50\x4B\x03\x04";
  }
}