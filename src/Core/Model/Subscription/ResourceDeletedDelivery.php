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
 * @method ResourceDeletedDelivery setProjectKey(string $projectKey = null)
 * @method string getNotificationType()
 * @method ResourceDeletedDelivery setNotificationType(string $notificationType = null)
 * @method Reference getResource()
 * @method ResourceDeletedDelivery setResource(Reference $resource = null)
 * @method int getVersion()
 * @method ResourceDeletedDelivery setVersion(int $version = null)
 * @method DateTimeDecorator getModifiedAt()
 * @method ResourceDeletedDelivery setModifiedAt(DateTime $modifiedAt = null)
 * @method UserProvidedIdentifiers getResourceUserProvidedIdentifiers()
 * phpcs:disable
 * @method ResourceDeletedDelivery setResourceUserProvidedIdentifiers(UserProvidedIdentifiers $resourceUserProvidedIdentifiers = null)
 * phpcs:enable
 * @method bool getDataErasure()
 * @method ResourceDeletedDelivery setDataErasure(bool $dataErasure = null)
 */
class ResourceDeletedDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition['version'] = [static::TYPE => 'int'];
        $definition['modifiedAt'] = [static::TYPE => DateTime::class, static::DECORATOR => DateTimeDecorator::class ];
        $definition['dataErasure'] = [static::TYPE => 'bool', static::OPTIONAL => true];

        return $definition;
    }
}
