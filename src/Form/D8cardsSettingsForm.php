<?php

/**

 * @file

 * Contains \Drupal\simple\Form\D8cardsSettingsForm.

 */

namespace Drupal\d8cards\Form;

use Drupal\Core\Form\ConfigFormBase;

use Drupal\Core\Form\FormStateInterface;

class D8cardsSettingsForm extends ConfigFormBase {
  /**

   * {@inheritdoc}

   */

  public function getFormId() {

    return 'simple_config_form';

  }


  /**

   * {@inheritdoc}

   */

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);

    $config = $this->config('d8cards.settings');

    $form['email'] = array(

      '#type' => 'textfield',

      '#title' => $this->t('Email'),

      '#default_value' => $config->get('d8cards.email'),

      '#required' => TRUE,

    );

    $node_types = \Drupal\node\Entity\NodeType::loadMultiple();

    $node_type_titles = array();

    foreach ($node_types as $machine_name => $val) {

      $node_type_titles[$machine_name] = $val->label();

    }

    $form['node_types'] = array(

      '#type' => 'checkboxes',

      '#title' => $this->t('Node Types'),

      '#options' => $node_type_titles,

      '#default_value' => $config->get('d8cards.node_types'),

    );

    return $form;

  }
  /**

   * {@inheritdoc}

   */

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $config = $this->config('d8cards.settings');

    $config->set('d8cards.email', $form_state->getValue('email'));

    $config->set('d8cards.node_types', $form_state->getValue('node_types'));

    $config->save();

    return parent::submitForm($form, $form_state);

  }
  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return [

      'd8cards.settings',

    ];

  }
}