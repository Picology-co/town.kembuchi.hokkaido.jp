<?php

namespace Drupal\common_utils\File;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\file\Entity\File;

class FileOperations {

      /**
   * 指定したパスの画像ファイルを取得し、ファイルエンティティを作成する
   *
   * @param string $file_path ストリームラッパーURI(例: public://image/product/sample.jpg)
   * @return \Drupal\file\Entity\File|null 取得したファイルエンティティ、またはNULL
   */
  public function getFileEntity($file_path) {
    // 既にファイルが存在するかチェック
    $files = \Drupal::entityTypeManager()->getStorage('file')->loadByProperties(['uri' => $file_path]);
    $file = reset($files);

    if (!$file) {
      // ファイルエンティティを新規作成
      if (!file_exists($file_path)) {
        return NULL;
      }
      $file = File::create([
        'uri' => $file_path,
        'status' => 1,  // 永続的なファイルとしてマーク
      ]);
      $file->save();
    }

    return $file;
  }
}