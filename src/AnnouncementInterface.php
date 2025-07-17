<?php

declare(strict_types=1);

namespace Drupal\announce_it;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an announcement entity type.
 */
interface AnnouncementInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
