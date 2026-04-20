<?php

namespace Drupal\custom_variable\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use DateTime;
use DateTimeZone;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Drupal\custom_variable\Setting;

class CustomVariableController extends ControllerBase {



  /**
   * カスタム変数設定フォームをレンダリングする
   */
  public function renderSettingForm() {

    $form = $this->formBuilder()->getForm('Drupal\custom_variable\Form\SettingForm');

    return [
      '#theme' => 'custom_variable_form', # .moduleの一意名
      '#form' => $form, # フォームを渡す
    ];
  }
}