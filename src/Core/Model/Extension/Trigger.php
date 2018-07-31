<?php
/**
 */

namespace Commercetools\Core\Model\Extension;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Extension
 *
 * @method string getResourceTypeId()
 * @method Trigger setResourceTypeId(string $resourceTypeId = null)
 * @method array getActions()
 * @method Trigger setActions(array $actions = null)
 */
class Trigger extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'resourceTypeId' => [static::TYPE => 'string'],
            'actions' => [static::TYPE => 'array'],
        ];
    }
}
