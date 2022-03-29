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
          var myAjaxObject = Drupal.ajax(ajaxSettings);
          myAjaxObject.execute();
        });
    }
  };

})(jQuery, Drupal);
