<?php

namespace Drupal\noty\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Flash a message as an action link is updated.
 *
 * The client side code can be found in js/flag-action_link_flash.js.
 *
 * @ingroup flag
 */
class NotyCommand implements CommandInterface {

  /**
   * Identifies the action link to be flashed.
   *
   * @var string
   */
  protected $style;

  /**
   * The message to be flashed under the link.
   *
   * @var string
   */
  protected $message;

  /**
   * Construct a message Flasher.
   *
   * @param string $selector
   *   Identifies the action link to be flashed.
   * @param string $message
   *   The message to be displayed.
   */
  public function __construct($message, $style = 'alert') {
    $this->style = $style;
    $this->message = $message;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    return [
      'command' => 'addNotyMessage',
      'style' => $this->style,
      'message' => $this->message,
    ];
  }

}
