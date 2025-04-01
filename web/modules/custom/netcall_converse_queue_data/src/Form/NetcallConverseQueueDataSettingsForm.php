<?php
namespace Drupal\netcall_converse_queue_data\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure settings for NetCall Converse Queue Data.
 */
class NetcallConverseQueueDataSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['netcall_converse_queue_data.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'netcall_converse_queue_data_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('netcall_converse_queue_data.settings');

    $form['api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Key'),
      '#default_value' => $config->get('api_key'),
      '#description' => $this->t('Enter your Converse API Key.'),
      '#required' => TRUE,
    ];

    $form['api_url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API Endpoint URL'),
      '#default_value' => $config->get('api_url'),
      '#description' => $this->t('Enter the URL for the Converse API endpoint.'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('netcall_converse_queue_data.settings')
      ->set('api_key', $form_state->getValue('api_key'))
      ->set('api_url', $form_state->getValue('api_url'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
