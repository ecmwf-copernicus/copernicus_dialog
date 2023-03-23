<?php

namespace Drupal\copernicus_dialog\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\CloseDialogCommand;
use Symfony\Component\HttpFoundation\Cookie;
use Drupal\copernicus_dialog\Utils\HelperFunctions;

class DialogController extends ControllerBase {

  /**
   * Open a dialog window
   */
  public function openDialog() {

    $config = $this->config('copernicus_dialog.settings');
    if (!$config->get('dialog_enabled')) {
      return ;
    }
    $cookieId = HelperFunctions::generateCookieId($config->get('dialog_title'));

    if (
      \Drupal::currentUser()->isAnonymous()
      && !\Drupal::request()->cookies->get($cookieId)
    ) {
      $title = $config->get('dialog_title');

      $content = [
        '#type' => 'processed_text',
        '#text' => $config->get('dialog_content')['value'],
        '#format' => $config->get('dialog_content')['format'],
      ];

      $response = new AjaxResponse();
      $options = [
        //'width' => $config->get('dialog_width'),
        'dialogClass' => 'copernicus_dialog',
      ];
      $response->addCommand(new OpenDialogCommand('#copernicus-dialog', $title, $content, $options));
      return $response;
    }

    return new AjaxResponse();
  }

  /**
   * Close the dialog and set cookie.
   */
  public function closeDialog(){

    $config = $this->config('copernicus_dialog.settings');
    $cookieId = HelperFunctions::generateCookieId($config->get('dialog_title'));

    $command = new CloseDialogCommand('#copernicus-dialog');
    $cookie = new Cookie($cookieId, TRUE);
    $response = new AjaxResponse();
    $response->addCommand($command);
    $response->headers->setCookie($cookie);
    return $response;
  }
}
