<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Model\Common\Reference;
use DateTime;
use Commercetools\Core\Model\Message\UserProvidedIdentifiers;

/**
 * @package Commercetools\Core\Model\Subscription
 * @method string getProjectKey()
 * @method ResourceUpdatedDelivery setProjectKey(string $projectKey = null)
 * @method string getNotificationType()
 * @method ResourceUpdatedDelivery setNotificationType(string $notificationType = null)
 * @method Reference getResource()
 * @method ResourceUpdatedDelivery setResource(Reference $resource = null)
 * @method int getVersion()
 * @method ResourceUpdatedDelivery setVersion(int $version = null)
 * @method int getOldVersion()
 * @method ResourceUpdatedDelivery setOldVersion(int $oldVersion = null)
 * @method DateTimeDecorator getModifiedAt()
 * @method ResourceUpdatedDelivery setModifiedAt(DateTime $modifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ResourceUpdatedDelivery setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ResourceUpdatedDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition['version'] = [static::TYPE => 'int'];
        $definition['oldVersion'] = [static::TYPE => 'int'];
        $definition['modifiedAt'] = [static::TYPE => DateTime::class, static::DECORATOR => DateTimeDecorator::class ];
        return $definition;
    }
}
