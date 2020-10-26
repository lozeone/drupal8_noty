# Noty.js flag messages in Drupal 8

Adds Noty.js to Drupal 8 Ajax commands and optionally replaces flag messages

This is just my first stab at this, it needs polish.

INTRODUCTION
------------
- Allows the use of noty.js for flag messages.
- Replaces flags default feedback messages with noty style messages.
- Provides a custom ajax command *NotyCommand* for adding a Noty message to
your ajax responses.

Usage:

    <?php
      $response->addResponse(new NotyCommand($message, $type));
    ?>
  
**$message** - the message text.

**$type** - a string for the Noty type option (alert, success, error, warning, info)


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
