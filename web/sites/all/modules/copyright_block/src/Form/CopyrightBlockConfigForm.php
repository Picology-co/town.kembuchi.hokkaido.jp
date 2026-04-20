<?php

namespace Drupal\copyright_block\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\copyright_block\DbControl;

class CopyrightBlockConfigForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'copyright_block_config_form_php'; # .moduleの一意名と重複してはいけないので_phpをつけて対応する
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // DBから値を読み込む
    $dbControl = new DbControl();
    $since = $dbControl->getSince();
    $format = $dbControl->getFormat();

    $form['since'] = [
      '#type' => 'number',
      '#title' => $this->t('Website launch year:'),
      '#min' => 1970,
      '#max' => (int) date('Y'),
      '#step' => 1,
      '#default_value' => (int) $since,
      '#required' => TRUE,
      '#description' => $this->t('Enter the year when the website was launched.'),
    ];

    $form['format'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Copyright format:'),
      '#default_value' => $format,
      '#required' => TRUE,
      '#description' => $this->t('Use @year for the year(If the year the website was established is the same as the current year, the exact year will be displayed, otherwise a range will be displayed.) and @sitename for the site name.Also, &amp;copy; displays &copy; and &amp;nbsp; represents a half-width space.<br>Example: &amp;copy; @year @sitename => &copy; 2023-2025 SiteName'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];

    $form['usage'] = [
      '#markup' => $this->t('<h3>Usage</h3><p><b>Block</b></p><p>Go to Administration, Site Building, Block Layout and place it in your region.</p><p><b>Twig</b></p><p>You can embed it in any Twig. Just write {{ copyright }} where you want to embed it.</p>'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $since = $form_state->getValue('since');
    $format = $form_state->getValue('format');

    // submitボタンをクリックしたときの処理
    $dbControl = new DbControl();
    $resultSince = $dbControl->setSince((string) $since);
    if (!$resultSince) {
      \Drupal::messenger()->addError($this->t('Failed to save the since year.'));
    }
    $resultFormat = $dbControl->setFormat($format);
    if (!$resultFormat) {
      \Drupal::messenger()->addError($this->t('Failed to save the format.'));
    }

    // すべてのキャッシュを再構築
    \Drupal::service('cache.bootstrap')->deleteAll();
    \Drupal::service('cache.config')->deleteAll();
    \Drupal::service('cache.discovery')->deleteAll();
    \Drupal::service('cache.entity')->deleteAll();
    \Drupal::service('cache.menu')->deleteAll();
    \Drupal::service('cache.render')->deleteAll();
    \Drupal::service('cache.static')->deleteAll();
    \Drupal::service('router.builder')->rebuild();
  }
}