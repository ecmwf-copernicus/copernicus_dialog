(function ($, Drupal) {
  'use strict';

  Drupal.behaviors.copernicusDialog = {
    attach: function(context) {
      const elements = once('copernicus-dialog', 'body', context);
      elements.forEach(function (element) {
        var ajaxSettings = {
          url: '/copernicus-dialog/open-dialog'
        };
        var ajaxObject = Drupal.ajax(ajaxSettings);
        ajaxObject.execute().done(function(){
          setTimeout (function(){
            $('.ui-dialog-titlebar-close').bind('click', function() {
              var ajaxSettings = {
                url: '/copernicus-dialog/close-dialog'
              };
              var ajaxObject = Drupal.ajax(ajaxSettings);
              ajaxObject.execute();
            });
          }, 100);
        });
      });
    }
  };

})(jQuery, Drupal);
