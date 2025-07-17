<?php
declare(strict_types=1);

namespace Drupal\announce_it\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class AnnouncementManager implements AnnouncementManagerInterface {
  protected EntityTypeManagerInterface $entityTypeManager;

  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  public function getVisibleAnnouncements(): array {
    $storage = $this->entityTypeManager->getStorage('announce_it_announcement');
    $query = $storage->getQuery()
      ->condition('status', 1)
      ->accessCheck(TRUE)
      ->sort('created', 'DESC');

    $ids = $query->execute();
    return $storage->loadMultiple($ids);
  }
}
