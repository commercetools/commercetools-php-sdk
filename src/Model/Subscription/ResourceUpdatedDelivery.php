<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Subscription;

use Commercetools\Core\Model\Common\Reference;

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
 */
class ResourceUpdatedDelivery extends Delivery
{
    public function fieldDefinitions()
    {
        $definition = parent::fieldDefinitions();
        $definition['version'] = [static::TYPE => 'int'];
        $definition['oldVersion'] = [static::TYPE => 'int'];
        return $definition;
    }
}
