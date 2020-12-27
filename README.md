# Noty.js flag messages in Drupal 8

Adds Noty.js to Drupal 8 Ajax commands and optionally replaces flag messages

This is just my first stab at this, it needs polish.

WHAT IT DOES
------------
- Replaces flags default feedback messages with noty style messages. (configurable per flag)
- Provides an ajax command *NotyCommand* for adding a Noty message to
your ajax responses.

Usage:

    <?php
      $response->addCommand(new NotyCommand($message, $settings));
    ?>


**$message** - the message text.

**$settings** - an array of options https://ned.im/noty/#/options
```
\\ The currently supported options are ...
[
  'type' => 'alert', // string - The Noty type (alert, success, error, warning, info)
  'timeout' => 3000, // int - The amount of time in millieseconds the message will stay on the screen
  'layout' => 'topCenter', // string - The position of the mesage
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


REQUIREMENTS
------------

Flag


CONFIGURATION
-------------

 * In the "Noty Messages" section of each flag edit form, you can set the
   severity level of the messages for each flag action.
