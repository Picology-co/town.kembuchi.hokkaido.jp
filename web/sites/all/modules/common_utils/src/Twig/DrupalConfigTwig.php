<?php

namespace Drupal\common_utils\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Drupal\common_utils\DebugTools\DebugUtils;

class DrupalConfigTwig extends AbstractExtension {

  public function getName() {
    return 'drupal_config_twig_php';
  }

  public function getFunctions() {
    return [
      new TwigFunction('config_value', [$this, 'getConfigValue']),
      new TwigFunction('config_name_lists', [$this, 'getConfigNameLists']),
    ];
  }

  /**
   * Drupalの汎用パラメータからキーの値を取得する。
   * @param string $system_name
   * @param string $key
   * @return string
   */
	public static function getConfigValue(string $system_name, string $key) {

		$config = \Drupal::config($system_name);
		return $config->get($key);

	}

  /**
   * Drupalの汎用パラメータから引数の値にマッチする名前(name)の一覧を取得する。
   * @param string $search_text
   * @return array
   */
  public static function getConfigNameLists(string $search_text) {

    try {
      $query = \Drupal::database()->select('config', 'c');
      $query->addField('c', 'name', 'name');
      $query->condition('c.name', '%' . $search_text . '%', 'like');
      $results = $query->execute()->fetchAll();

      $names = [];
      foreach ($results as $row) {
        $names[] = $row->name;
      }
      return $names;
    }
    catch (\Exception $e) {
      \Drupal::logger('product_check')->error('[Query Error]getConfigNameLists: ' . $e->getMessage() . ' | Query: ' . $query->__toString());
      return null;
    }
  }
}
