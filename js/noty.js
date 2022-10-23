(function($, Drupal, drupalSettings) {

  // =============================
  Drupal.AjaxCommands.prototype.addNotyMessage = function(ajax, response, status) {

    if (status === 'success' && response.message && response.type) {
      new Noty({
        text: response.message,
        theme: 'relax',
        layout: response.layout,
        type: response.type,
        buttons: false,
        killer: true,
        timeout: response.timeout,
        animation: {
          open: 'animated fadeInDown fast', // Animate.css class names
          close: 'animated fadeOutUp fast'  // Animate.css class names
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
