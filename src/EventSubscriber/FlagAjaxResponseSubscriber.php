<?php

namespace Drupal\noty\EventSubscriber;

use Drupal\noty\Ajax\NotyCommand;
use Drupal\flag\Event\FlagEvents;
use Drupal\flag\Event\FlagResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Alter a Flag Ajax Response.
 */
class FlagAjaxResponseSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[FlagEvents::RESPONSE][] = ['onResponse'];
    return $events;
  }

  /**
   * Allows us to alter the Ajax response from a flag.
   *
   * @param \Drupal\flag\Event\FlagResponseEvent $event
   *   The event process.
   */
  public function onResponse(FlagResponseEvent $event) {
    $response = $event->getResponse();

    // Only act on a Flags Ajax Response.
    if ($response instanceof \Drupal\Core\Ajax\AjaxResponse) {

      $flag = $event->getFlag();
      $settings = $flag->getThirdPartySetting('noty', 'settings');

      $flag_action = $event->getActionType(); // either 'flag' or 'unflag'
      if (!empty($settings[$flag_action])) {
        $settings['type'] = $settings[$flag_action];
        $response->addCommand(new NotyCommand($flag->getMessage($flag_action), $settings));
      }
    }
  }
}
