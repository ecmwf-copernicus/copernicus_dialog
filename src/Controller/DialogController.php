<?php

namespace Drupal\copernicus_dialog\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Symfony\Component\HttpFoundation\Cookie;

class DialogController extends ControllerBase {

  /**
   * Open a modal window
   */
  public function openModal() {

    $config = $this->config('copernicus_dialog.settings');

    if (
      $config->get('dialog_enabled')
      && \Drupal::currentUser()->isAnonymous()
      && !\Drupal::request()->cookies->get('copernicus_dialog')
    ) {
      $title = $config->get('dialog_title');

      $confirmation_form = $this->formBuilder()->getForm('Drupal\copernicus_dialog\Form\ConfirmationDialogForm');
      $content = [
        '#type' => 'processed_text',
        '#text' => $config->get('dialog_content')['value'],
        '#format' => $config->get('dialog_content')['format'],
        'submit' => [
          $confirmation_form['submit']
        ],
      ];

      $response = new AjaxResponse();
      $options = [
        //'width' => $config->get('dialog_width'),
        'dialogClass' => 'copernicus_dialog',
      ];
      $response->addCommand(new OpenModalDialogCommand($title, $content, $options));
      return $response;
    }
  }

  /**
   * close the modal and set cookie
   */
  public function closeModal(){
    $command = new CloseModalDialogCommand();
    $cookie = new Cookie('copernicus_dialog', TRUE);
    $response = new AjaxResponse();
    $response->addCommand($command);
    $response->headers->setCookie($cookie);
    return $response;
  }
}
