<?php
declare(strict_types=1);

namespace Drupal\announce_it\Render;

use Drupal\announce_it\Service\AnnouncementManagerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Render\Markup;

class AnnouncementRenderer implements AnnouncementRendererInterface {

  protected AnnouncementManagerInterface $manager;
  protected ConfigFactoryInterface $configFactory;

  public function __construct(AnnouncementManagerInterface $manager, ConfigFactoryInterface $configFactory) {
    $this->manager = $manager;
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public function render(): array {
    $output = [];

    foreach ($this->manager->getVisibleAnnouncements() as $announcement) {
      $message = $announcement->get('field_message')->value;
      $position = $announcement->get('field_position')->value;
      $is_bar = in_array($position, ['top', 'bottom']);
      $css_class = $announcement->get('field_css_class')->value;

      $classes = ['announce-it'];
      $classes[] = $is_bar ? 'bar' : 'popup';
      $classes[] = $position;
      $classes[] = $css_class;

      $output['announce_it_' . $announcement->id()] = [
        '#type' => 'container',
        '#attributes' => [
          'class' => $classes,
        ],
        'content' => [
          '#markup' => Markup::create($message),
        ],
      ];
    }

    return $output;
  }

  /**
   * {@inheritdoc}
   */
  public function attachCssVariables(array &$attachments): void {
    $config = $this->configFactory->get('announce_it.settings');

    $css = sprintf(':root {
      --announcement-bg-color: %s;
      --announcement-text-color: %s;
      --announcement-padding-y: %spx;
      --announcement-padding-x: %spx;
    }',
      $config->get('background_color'),
      $config->get('text_color'),
      $config->get('padding_y'),
      $config->get('padding_x')
    );

    $attachments['#attached']['html_head'][] = [
      [
        '#tag' => 'style',
        '#attributes' => ['type' => 'text/css'],
        '#value' => $css,
      ],
      'announce-it-css-vars',
    ];
  }
}
