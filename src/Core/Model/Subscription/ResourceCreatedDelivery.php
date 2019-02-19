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
 * @method ResourceCreatedDelivery setProjectKey(string $projectKey = null)
 * @method string getNotificationType()
 * @method ResourceCreatedDelivery setNotificationType(string $notificationType = null)
 * @method Reference getResource()
 * @method ResourceCreatedDelivery setResource(Reference $resource = null)
 * @method int getVersion()
 * @method ResourceCreatedDelivery setVersion(int $version = null)
 * @method DateTimeDecorator getModifiedAt()
 * @method ResourceCreatedDelivery setModifiedAt(DateTime $modifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ResourceCreatedDelivery setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 */
class ResourceCreatedDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition['version'] = [static::TYPE => 'int'];
        $definition['modifiedAt'] = [static::TYPE => DateTime::class, static::DECORATOR => DateTimeDecorator::class ];
        return $definition;
    }
}
