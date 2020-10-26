(function($, Drupal, drupalSettings) {

  // =============================

  Drupal.AjaxCommands.prototype.addNoty = function(ajax, response, status) {

    if (status === 'success' && response.message && response.style) {
      new Noty({
        text: response.message,
        theme: 'relax',
        layout: 'topCenter',
        type: response.style,
        buttons: false,
        killer: true,
        timeout: 3000,
        animation: {
          open: 'animated fadeInDown fast', // Animate.css class names
          close: 'animated fadeOutUp fast' //, // Animate.css class names
          //easing: 'swing', // unavailable - no need
          //speed: 500 // unavailable - no need
        }
      }).show();
    } else {
      var links = [].concat(_toConsumableArray(document.querySelectAll('.flag-waiting')));
      links.forEach(function(link) {
        return link.classList.remove('flag-waiting');
      });
    }
  }

})(jQuery, Drupal, drupalSettings);
