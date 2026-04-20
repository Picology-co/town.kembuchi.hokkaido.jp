<?php

namespace Drupal\custom_variable\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\custom_variable\Setting;

class SettingForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_variable_form_php'; # .moduleの一意名と重複してはいけないので_phpをつけて対応する
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $request = \Drupal::request();

    $task = $request->query->get('task'); // 0:新規 1:更新
    if (empty($task)) {
      $task = 0;
    }
    elseif ($task != 1) { // 1以外の場合は0にする
      $task = 0;
    }

    if ($task == 0) { // 新規

      $form['setting'] = [
        '#type' => 'table',
        '#header' => [
          'key' => 'Key',
          'detail' => 'Description',
          'value' => 'Value',
        ],
      ];

      $form['setting'][0]['key'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Key'),
        '#title_display' => 'invisible',
        '#required' => TRUE,
      ];

      $form['setting'][0]['detail'] = [
        '#type' => 'textfield',
        '#title' => 'Description',
        '#title_display' => 'invisible',
        '#required' => TRUE,
      ];

      $form['setting'][0]['value'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Value'),
        '#title_display' => 'invisible',
        '#required' => TRUE,
      ];

      $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Register'),
        '#button_type' => 'primary',
        '#submit' => ['::submitForm'], // デフォルト
      ];

      $form['link'] = [
        '#markup' => '<a href="?task=1">Update</a>'
      ];
    }
    else { // 更新
      $setting = new Setting();
      $setting_value = $setting->getCustomVariable();
      $i = 0;
      if (!empty($setting_value)) {

        $form['setting'] = [
          '#type' => 'table',
          '#header' => [
            'key' => 'Key',
            'detail' => 'Description',
            'value' => 'Value',
          ],
        ];

        foreach ($setting_value as $setting_row) {
          $form['setting'][$i]['key'] = [
            '#markup' => $setting_row->key,
          ];

          $form['setting'][$i]['detail'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Description'),
            '#title_display' => 'invisible',
            '#default_value' => $setting_row->detail,
            '#required' => TRUE,
          ];

          $form['setting'][$i]['value'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Value'),
            '#title_display' => 'invisible',
            '#default_value' => $setting_row->value,
            '#required' => TRUE,
          ];

          $form['setting'][$i]['key_hide'] = [
            '#type' => 'hidden',
            '#default_value' => $setting_row->key,
          ];

          $i++;
        }

        $form['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Update'),
          '#button_type' => 'primary',
          '#submit' => ['::submitUpdateData'], // デフォルト
        ];
      } else {
        $form['setting']['detail'] = [
          '#markup' => $this->t('<p>There are currently no custom variables registered. Please register a new one.</p>'),
        ];
      }

      $form['link'] = [
        '#markup' => '<a href="?task=0">Register</a>'
      ];

    }

    $form['usage'] = [
      '#markup' => "<p><b>Usage:</b><br>Please write {{ custom_variable('@key') }} in any Twig. (@key is the name of the key. And please enclose @key in single quotes.)</p>"
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // submitボタンをクリックしたときの処理(新規登録)
    $setting = $form_state->getValue('setting');

    foreach ($setting as $setting_row) {
      $setting_array = [
        'key' => $setting_row['key'],
        'value' => $setting_row['value'],
        'detail' => $setting_row['detail'],
      ];
      // Keyの重複チェック
      $setting_php = new Setting();
      $exist_key = $setting_php->getCustomVariable($setting_row['key']);
      if (!empty($exist_key)) {
        \Drupal::messenger()->addWarning($this->t('Key[@key] has already been registered.', [
          '@key' => $setting_row['key'],
        ]));
      }
      else {
        $setting_php->setCustomVariable($setting_array);
        \Drupal::messenger()->addMessage($this->t('Key[@key] registered.(Value is [@value])', [
          '@key' => $setting_row['key'],
          '@value' => $setting_row['value'],
        ]));
      }
    }

  }

  public function submitUpdateData(array &$form, FormStateInterface $form_state) {

    // submitボタンをクリックしたときの処理(更新)
    $setting = $form_state->getValue('setting');
    foreach ($setting as $setting_row) {
      $setting_array = [
        'key' => $setting_row['key_hide'],
        'value' => $setting_row['value'],
        'detail' => $setting_row['detail'],
      ];

      // 値が変更されているかチェック
      $setting_php = new Setting();
      $exist_value = $setting_php->getCustomVariable($setting_row['key_hide']);
      foreach ($exist_value as $exist_value_row) {
        if ($exist_value_row->value != $setting_row['value'] or $exist_value_row->detail != $setting_row['detail']) {
          // 値か説明が変更されている
          $setting_php->updateCustomVariable($setting_array);
          \Drupal::messenger()->addMessage($this->t('Key[@key] updated.(Value is [@value])', [
            '@key' => $setting_row['key_hide'],
            '@value' => $setting_row['value'],
          ]));
        }
      }

    }
  }

}