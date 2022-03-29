(function ($, Drupal) {
  'use strict';

  Drupal.behaviors.copernicusDialog = {
    attach: function(context) {
      $(context).find('body')
        .once('copernicus-dialog')
        .each(function () {
          var ajaxSettings = {
            url: '/copernicus-dialog/open-dialog'
          };
          var ajaxObject = Drupal.ajax(ajaxSettings);
          ajaxObject.execute().done(function(){
            $('.ui-dialog-titlebar-close').bind('click', function() {
              var ajaxSettings = {
                url: '/copernicus-dialog/close-dialog'
              };
              var ajaxObject = Drupal.ajax(ajaxSettings);
              ajaxObject.execute();
            });
          });
        });
    }
  };

})(jQuery, Drupal);
