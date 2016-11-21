<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Reference;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Subscription
 * @method string getProjectKey()
 * @method MessageDelivery setProjectKey(string $projectKey = null)
 * @method string getNotificationType()
 * @method MessageDelivery setNotificationType(string $notificationType = null)
 * @method Reference getResource()
 * @method MessageDelivery setResource(Reference $resource = null)
 * @method string getId()
 * @method MessageDelivery setId(string $id = null)
 * @method int getVersion()
 * @method MessageDelivery setVersion(int $version = null)
 * @method int getSequenceNumber()
 * @method MessageDelivery setSequenceNumber(int $sequenceNumber = null)
 * @method int getResourceVersion()
 * @method MessageDelivery setResourceVersion(int $resourceVersion = null)
 * @method DateTimeDecorator getCreatedAt()
 * @method MessageDelivery setCreatedAt(\DateTime $createdAt = null)
 * @method DateTimeDecorator getLastModifiedAt()
 * @method MessageDelivery setLastModifiedAt(\DateTime $lastModifiedAt = null)
 */
class MessageDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition = array_merge(
            $definition,
            [
                'id' => [static::TYPE => 'string'],
                'version' => [static::TYPE => 'int'],
                'sequenceNumber' => [static::TYPE => 'int'],
                'resourceVersion' => [static::TYPE => 'int'],
                'createdAt' => [
                    static::TYPE => '\DateTime',
                    static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
                ],
                'lastModifiedAt' => [
                    static::TYPE => '\DateTime',
                    static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
                ],
            ]
        );
        return $definition;
    }
}
