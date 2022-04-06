<?php

namespace Drupal\copernicus_dialog\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ConfirmationDialogForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'confirmation_dialog_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('copernicus_dialog.settings');
    $form['submit'] = [
      '#type' => 'link',
      '#title' => $this->t($config->get('dialog_button')),
      '#url' => Url::fromRoute('copernicus_dialog.close_dialog'),
      '#attributes' => [
        'class' => [
          'ccl-button',
          'ccl-button--default',
          'close-button',
          'use-ajax'
        ],
        //'onclick' => "$('.ui-dialog-titlebar-close').click();",
      ],
      '#ajax' => [
         // 'callback' => [$this, ''],
        'event' => 'click',
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }
}
