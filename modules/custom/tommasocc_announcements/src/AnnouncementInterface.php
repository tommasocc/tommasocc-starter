<?php

namespace Drupal\tommasocc_announcements;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an announcement entity type.
 */
interface AnnouncementInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
