<?php
declare(strict_types=1);

namespace Drupal\announce_it\Service;

interface AnnouncementManagerInterface {

  /**
   * Get all visible announcements.
   *
   * @return \Drupal\announce_it\Entity\AnnouncementInterface[]
   */
  public function getVisibleAnnouncements(): array;
}
