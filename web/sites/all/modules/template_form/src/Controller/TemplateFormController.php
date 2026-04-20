<?php

namespace Drupal\template_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use Drupal\template_form\CommonUtils;
use DateTime;
use DateTimeZone;

class TemplateFormController extends ControllerBase {

  /**
   * フォームをレンダリングする
   */
  public function renderForm() {
    $form = $this->formBuilder()->getForm('Drupal\template_form\Form\TemplateForm');
    $request = \Drupal::request();

    return [
      '#theme' => 'template_form', # .moduleの一意名
      '#form' => $form, # フォームを渡す
      '#data' => $request, # Twigテンプレートに渡す変数
    ];
  }
}