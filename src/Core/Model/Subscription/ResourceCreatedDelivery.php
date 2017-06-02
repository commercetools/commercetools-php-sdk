<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Reference;

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
 */
class ResourceCreatedDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition['version'] = [static::TYPE => 'int'];
        return $definition;
    }
}
