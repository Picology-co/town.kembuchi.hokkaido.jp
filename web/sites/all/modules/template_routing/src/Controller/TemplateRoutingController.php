<?php

namespace Drupal\template_routing\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Drupal\contact_management\CommonUtils;

class TemplateRoutingController extends ControllerBase {

  /**
   *
   * @return array
   *
   */
  public function content() {

    $request = \Drupal::request();
    $data1 = null;
    $data2 = null;

    return [
      '#theme' => 'template_routing', // .moduleの一意名
      '#data' => $request, // Twigテンプレートに渡す変数
      '#data1' => $data1,
      '#data2' => $data2,
    ];
  }

}
