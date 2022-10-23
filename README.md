# Noty.js flag messages in Drupal 8/9

Adds Noty.js to Drupal 8/9 Ajax commands and optionally replaces flag messages

This is just my first stab at this, it needs polish.

WHAT IT DOES
------------
- Optionally Replaces flags default feedback messages with noty style messages. (configurable per flag)
- Provides an ajax command *NotyCommand* for adding a Noty message to your own ajax responses.

Usage:

    <?php
      use Drupal\noty\Ajax\NotyCommand;
      
      $response->addCommand(new NotyCommand($message, $settings));
    ?>


**$message** - the message text.

**$settings** - an array of options https://ned.im/noty/#/options
```
\\ The currently supported options are ...
[
  'type'    => 'alert',     // string - The Noty type (alert, success, error, warning, info)
  'timeout' => 3000,        // int - The amount of time in millieseconds the message will stay on the screen
  'layout'  => 'topCenter', // string - The position of the message
]
```


INSTALLATION
------------

 * Place the noty folder in your module directory and enable it.

 * You will need to download the Noty.js library and place it in your libraries
   Folder. Where the path is /libraries/noty/lib/noty.min.js
   You can download the library here: https://github.com/needim/noty

 * Requires the following patch for the flag module:
   https://www.drupal.org/project/flag/issues/3062604
   Otherwise you can just call it in your own code with <code>$response->addCommand(new NotyCommand($message, $settings));</code>


REQUIREMENTS
------------

Flag


CONFIGURATION
-------------

 * In the "Noty Messages" section of each flag edit form, you can set the
   severity level, timeout, and position for each flag action.
