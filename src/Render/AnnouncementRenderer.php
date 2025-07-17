<?php
declare(strict_types=1);

namespace Drupal\announce_it\Render;

use Drupal\announce_it\Service\AnnouncementManagerInterface;
use Drupal\Core\Render\Markup;

class AnnouncementRenderer implements AnnouncementRendererInterface {
  protected AnnouncementManagerInterface $manager;

  public function __construct(AnnouncementManagerInterface $manager) {
    $this->manager = $manager;
  }

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
}
