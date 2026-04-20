<?php

namespace Drupal\template_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\Core\Url;
use Drupal\order_answers\CommonUtils;

class TemplateForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'template_form_php'; # .moduleの一意名と重複してはいけないので_phpをつけて対応する
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $request = \Drupal::request();

    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('テキストタイトル'),
      '#required' => TRUE,
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('送信'),
      '#button_type' => 'primary',
    ];

    // $requestに入力値を入れて$formを返す
    $request->query->set('text', $form_state->get('text'));
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // submitボタンをクリックしたときの処理

  }
}