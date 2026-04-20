<?php

namespace Drupal\template_event_handling\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;

class TemplateEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [
      KernelEvents::REQUEST => 'onKernelRequest', // イベント名 => 処理内容
    ];
  }

  /**
   * Responds to kernel request events.
   *
   * @param \Symfony\Component\EventDispatcher\Event $event
   *   The event to process.
   */
  public function onKernelRequest(Event $event) {
    // 処理内容を記述する
  }
}