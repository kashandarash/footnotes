<?php

namespace Drupal\module_test\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure twitter feed auth settings.
 */
class FootnotesForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'footnotes_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['footnotes_settings.test'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('footnotes_settings.test');

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title for footnotes block'),
      '#default_value' => $config->get('title'),
      '#description' => $this->t('Rewrite default title "Footnotes".')
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('footnotes_settings.test')
      ->set('title', $form_state->getValue('title'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
