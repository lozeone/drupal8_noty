<?php

namespace Drupal\noty\EventSubscriber;

use Drupal\flag\Ajax\ActionLinkAjaxResponse;
use Drupal\noty\Ajax\NotyCommand;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Alter a Flag Ajax Response.
 */
class FlagAjaxResponseSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['onResponse'];
    return $events;
  }

  /**
   * Allows us to alter the Ajax response from a flag.
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
   *   The event process.
   */
  public function onResponse(FilterResponseEvent $event) {
    $response = $event->getResponse();

    // Only act on a Flags Ajax Response.
    if ($response instanceof ActionLinkAjaxResponse) {

      $flag_id = $response->getFlagId();
      $flag = \Drupal::service('flag')->getFlagById($flag_id);

      $settings = $flag->getThirdPartySetting('noty', 'settings');

      $flag_action = $response->getFlagAction();
      if (!empty($settings[$flag_action])) {
        $type = $settings[$flag_action];
        $response->addCommand(new NotyCommand($flag->getMessage($flag_action), $type));
      }
    }
  }
}
