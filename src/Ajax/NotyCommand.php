<?php

namespace Drupal\noty\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Displays a Noty message when an an action link is updated.
 *
 * The client side code can be found in js/noty.js.
 *
 * @ingroup flag
 */
class NotyCommand implements CommandInterface {

  /**
   * The type option of the Noty message.
   *
   * @var string
   */
  protected $type;

  /**
   * The message to be shown.
   *
   * @var string
   */
  protected $message;

  /**
   * The amount of time the message will be on the screen in milliseconds.
   *
   * @var int
   */
  protected $timeout;

  /**
   * The position of the message.
   *
   * @var string
   */
  protected $layout;

  /**
   * Construct a message Noty.
   *
   * @param string $message
   *   The message text to display.
   * @param array $settings
   *   an array of settings to pass to noty.js.
   *
   */
  public function __construct($message, $settings = []) {
    $this->type = isset($settings['type']) ? $settings['type'] : 'alert';
    $this->message = $message;
    $this->timeout = isset($settings['timeout']) ? $settings['timeout'] : 3000;
    $this->layout = isset($settings['layout']) ? $settings['layout'] : 'topCenter';
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    return [
      'command' => 'addNotyMessage',
      'type' => $this->type,
      'message' => $this->message,
      'timeout' => $this->timeout,
      'layout' => $this->layout,
    ];
  }

}
