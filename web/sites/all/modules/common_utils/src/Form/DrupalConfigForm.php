<?php

namespace Drupal\common_utils\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\common_utils\DebugTools\DebugUtils;

class DrupalConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'drupal_config_form_php'; # .moduleの一意名と重複してはいけないので_phpをつけて対応する
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $request = \Drupal::request();
    $filter_text = $request->query->get('filter_text');
    $style = $request->query->get('style');

    if (isset($filter_text)) {
      $form['markup_text'] = [
        '#type' => 'markup',
        '#markup' => $this->t('<a href="?style=array&filter_text=@filter_text">配列で表示</a><a href="?style=json&filter_text=@filter_text">JSONで表示</a><p><b><u>モジュールから呼び出す方法</u></b><br><span>use Drupal\common_utils\Config\DrupalConfig;</span><br><span>$setting = new DrupalConfig($name);</span><br><span>$value = $setting->getConfig($key);</span><br><b><u>Twigから呼び出す方法</u></b><br><span>{{ config_value($name, $key) }}</span><br>で個別に設定を取得できます。</p>', [
          '@filter_text' => $filter_text,
        ]),
      ];
    }
    else {
      $form['markup_text'] = [
        '#type' => 'markup',
        '#markup' => $this->t('<a href="?style=array">配列で表示</a><a href="?style=json">JSONで表示</a><p><b><u>モジュールから呼び出す方法</u></b><br><span>use Drupal\common_utils\Config\DrupalConfig;</span><br><span>$setting = new DrupalConfig($name);</span><br><span>$value = $setting->getConfig($key);</span><br><b><u>Twigから呼び出す方法</u></b><br><span>{{ config_value($name, $key) }}</span><br>で個別に設定を取得できます。</p>'),
      ];
    }

    $form['filter_text'] = [
      '#type' => 'textfield',
      '#default_value' => $filter_text,
      '#attributes' => [
        'placeholder' => t('名称(name)でフィルタリングします。'),
      ],
    ];

    $form['style'] = [
      '#type' => 'hidden',
      '#default_value' => $style,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('フィルタ'),
      '#button_type' => 'primary',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // submitボタンをクリックしたときの処理
    $request = \Drupal::request();
    $filter_text = $form_state->getValue('filter_text');
    $style = $form_state->getValue('style');

    $request->query->set('filter_text', $filter_text);
    $request->query->set('style', $style);

  }
}