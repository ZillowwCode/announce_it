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

  /**
   * Injects dynamic CSS variables for announcements styling from the configuration form.
   *
   * @param array $attachments
   *  The render attachments array to which CSS variables will be added.
   */
  public function attachCssVariables(array &$attachments): void;
}
