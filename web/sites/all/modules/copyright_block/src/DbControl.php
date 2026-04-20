<?php

namespace Drupal\copyright_block;

class DbControl {

  /**
   * Since（年）を格納する。
   * @param string $since
   * @return bool
   */
  public function setSince(string $since) {

    try {
      // データベース接続を取得
      $connection = \Drupal::database();
      // データを更新
      $query = $connection->update('copyright_block__since')
        ->fields([
          'since' => $since,
          'changed' => date('U'),
          ])
        ->condition('id', 1, '=')
        ->execute();

      return true;

    } catch (\Exception $e) {
      \Drupal::logger('copyright_block')->error($e->getMessage());
      return false;
    }

  }

  /**
   * Since（年）を取得する。
   * @return string
   */
  public function getSince() {

    try {
      // データベース接続を取得
      $connection = \Drupal::database();
      // データを取得
      $query = $connection->select('copyright_block__since', 'c');
      $query->addField('c', 'since', 'since');
      $query->condition('id', 1, '=');

      $result = $query->execute()->fetchField();

      return $result ? (string) $result : date('Y');

    } catch (\Exception $e) {
      \Drupal::logger('copyright_block')->error($e->getMessage());
      return date('Y');
    }
  }

  /**
   * フォーマットを格納する。
   * @param string $format
   * @return bool
   */
  public function setFormat(string $format) {

    try {
      // データベース接続を取得
      $connection = \Drupal::database();
      // データを更新
      $query = $connection->update('copyright_block__format')
        ->fields([
          'format' => $format,
          'changed' => date('U'),
          ])
        ->condition('id', 1, '=')
        ->execute();

      return true;

    } catch (\Exception $e) {
      \Drupal::logger('copyright_block')->error($e->getMessage());
      return false;
    }
  }

  /**
   * フォーマットを取得する。
   * @return string|null
   */
  public function getFormat() {

    try {
      // データベース接続を取得
      $connection = \Drupal::database();
      // データを取得
      $query = $connection->select('copyright_block__format', 'c');
      $query->addField('c', 'format', 'format');
      $query->condition('id', 1, '=');

      $result = $query->execute()->fetchField();

      return $result ? (string) $result : null;

    } catch (\Exception $e) {
      \Drupal::logger('copyright_block')->error($e->getMessage());
      return null;
    }
  }
}
