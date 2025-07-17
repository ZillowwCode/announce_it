<?php
declare(strict_types=1);

namespace Drupal\announce_it\Render;

interface AnnouncementRendererInterface {
  /**
   * Render all visible announcements for display.
   *
   * @return array
   *  A renderable array.
   */
  public function render(): array;
}
