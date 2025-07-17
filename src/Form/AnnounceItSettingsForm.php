<?php
declare(strict_types=1);

namespace Drupal\announce_it\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure default settings for the Announce It! module.
 */
class AnnounceItSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['announce_it.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'announce_it_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('announce_it.settings');

    $form['background_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Background color'),
      '#default_value' => $config->get('background_color'),
    ];

    $form['text_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Text color'),
      '#default_value' => $config->get('text_color'),
    ];

    $form['border_color'] = [
      '#type' => 'color',
      '#title' => $this->t('Border color'),
      '#description' => $this->t('This color will be used for the border of pop-up announcements.'),
      '#default_value' => $config->get('border_color'),
    ];

    $form['padding_y'] = [
      '#type' => 'number',
      '#title' => $this->t('Vertical padding'),
      '#default_value' => $config->get('padding_y'),
      '#min' => 0,
      '#step' => 5,
    ];

    $form['padding_x'] = [
      '#type' => 'number',
      '#title' => $this->t('Horizontal padding'),
      '#default_value' => $config->get('padding_x'),
      '#min' => 0,
      '#step' => 5,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->configFactory()->getEditable('announce_it.settings')
      ->set('background_color', $form_state->getValue('background_color'))
      ->set('text_color', $form_state->getValue('text_color'))
      ->set('border_color', $form_state->getValue('border_color'))
      ->set('padding_y', $form_state->getValue('padding_y'))
      ->set('padding_x', $form_state->getValue('padding_x'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
