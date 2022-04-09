<?php

namespace Drupal\copernicus_dialog\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CopernicusSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'copernicus_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    // Load settings
    $config = $this->config('copernicus_dialog.settings');
    // Enabled
    $form['dialog_enabled'] = array(
      '#type' => 'checkbox',
      '#title' => t('Enabled'),
      '#description' => t('Show/Hide dialog'),
      '#default_value' => $config->get('dialog_enabled'),
    );
    // Page title
    $form['dialog_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title:'),
      '#default_value' => $config->get('dialog_title'),
      '#description' => $this->t('Warning: The title is used to compute the cookie ID so when the title is changed all the users who previously hid the dialog will see it again.'),
      '#required' => TRUE,
      '#required_error' => t('Please add a title.'),
    ];
    // Body html
    $form['dialog_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content:'),
      '#default_value' => $config->get('dialog_content')['value'],
      '#description' => $this->t('The HTML content shown in the dialog window.'),
      '#format' => $config->get('dialog_content')['format'],
    ];
    // Confirmation button text
    // $form['dialog_button'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Button Text:'),
    //   '#default_value' => $config->get('dialog_button'),
    //   '#description' => $this->t('Text displayed on the confirmation button.'),
    // ];
    // Width of the dialog window
    // $form['dialog_width'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Width:'),
    //   '#default_value' => $config->get('dialog_width'),
    //   '#description' => $this->t('Width of the dialog window.'),
    // ];

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('copernicus_dialog.settings');
    $config->set('dialog_enabled', $form_state->getValue('dialog_enabled'));
    $config->set('dialog_content', $form_state->getValue('dialog_content'));
    $config->set('dialog_title', $form_state->getValue('dialog_title'));
    //$config->set('dialog_button', $form_state->getValue('dialog_button'));
    //$config->set('dialog_width', $form_state->getValue('dialog_width'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'copernicus_dialog.settings',
    ];
  }
}
