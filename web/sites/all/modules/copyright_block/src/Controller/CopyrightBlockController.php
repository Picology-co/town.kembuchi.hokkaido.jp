<?php

namespace Drupal\copyright_block\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use DateTime;
use DateTimeZone;

class CopyrightBlockController extends ControllerBase {

  /**
   * Copyright Blockの設定をレンダリングする。
   */
  public function renderConfig() {

    $form = $this->formBuilder()->getForm('Drupal\copyright_block\Form\CopyrightBlockConfigForm');

    return [
      '#theme' => 'copyright_block_config', # .moduleの一意名
      '#form' => $form,
    ];
  }
}