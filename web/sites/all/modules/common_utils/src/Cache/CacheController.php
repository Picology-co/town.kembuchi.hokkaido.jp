<?php

namespace Drupal\common_utils\Cache;

class CacheController {

  /**
   * Twigキャッシュをクリアする
   */
  public function clearTwigCache() {

    \Drupal::service('cache.render')->invalidateAll();
    \Drupal::service('cache.discovery')->invalidateAll();

  }
}