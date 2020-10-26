<?php

namespace Drupal\noty\EventSubscriber;

use Drupal\flag\Ajax\ActionLinkAjaxResponse;
use Drupal\noty\Ajax\NotyCommand;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Alter a Views Ajax Response.
 */
class FlagAjaxResponseSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = ['onResponse'];
    //$events[KernelEvents::REQUEST][] = ['onRequest'];
    return $events;
  }

  /**
   * Allows us to alter the Ajax response from a view.
   *
   * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
   *   The event process.
   */
  public function onResponse(FilterResponseEvent $event) {
    $response = $event->getResponse();

    // Only act on a Views Ajax Response.
    if ($response instanceof ActionLinkAjaxResponse) {
      $flag_id = $response->getFlagId();
      $flag_service = \Drupal::service('flag');
      $flag = $flag_service->getFlagById($flag_id);

      $settings = $flag->getThirdPartySetting('noty', 'settings');

      $action = $response->getFlagAction();
      if (!empty($settings[$action])) {
        $style = $settings[$action];
        $response->addCommand(new NotyCommand($flag->getMessage($action), $style));
      }

    //  dsm($settings, 'onResponse');
    //  dsm($response);
      // Only act on the view to tweak.
      /*if ($view->storage->id() === 'MY_VIEW') {
    $response->addCommand(new AfterViewsAjaxCommand());
    }*/
    }
  }
  public function onRequest(GetResponseEvent $event) {
    $response = $event->getResponse();

    // Only act on a Views Ajax Response.
    if ($response instanceof ActionLinkAjaxResponse) {
      $flag = $response->getFlagId();
      dsm($flag, 'onRequest');
      // Only act on the view to tweak.
      /*if ($view->storage->id() === 'MY_VIEW') {
    $response->addCommand(new AfterViewsAjaxCommand());
    }*/
    }
  }
}
