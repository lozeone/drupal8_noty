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
   * Construct a message Noty.
   *
   * @param string $selector
   *   Identifies the action link to be flashed.
   * @param string $message
   *   The message to be displayed.
   */
  public function __construct($message, $type = 'alert') {
    $this->type = $type;
    $this->message = $message;
  }

  /**
   * {@inheritdoc}
   *
   * @todo - should allow passing more config options here.
   */
  public function render() {
    return [
      'command' => 'addNotyMessage',
      'type' => $this->type,
      'message' => $this->message,
    ];
  }

}
