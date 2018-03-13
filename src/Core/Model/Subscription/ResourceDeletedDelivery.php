<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Reference;

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
 */
class ResourceDeletedDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition['version'] = [static::TYPE => 'int'];
        return $definition;
    }
}
