<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomObject;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\Resource;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\CustomObject
 * @link https://dev.commercetools.com/http-api-projects-custom-objects.html#create-a-customobject
 * @method string getContainer()
 * @method CustomObjectDraft setContainer(string $container = null)
 * @method string getKey()
 * @method CustomObjectDraft setKey(string $key = null)
 * @method mixed getValue()
 * @method CustomObjectDraft setValue($value = null)
 */
class CustomObjectDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'container' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string'],
            'value' => [],
        ];
    }

    /**
     * @param $value
     * @param Context|callable $context
     * @return mixed
     */
    public static function ofContainerKeyAndValue($container, $key, $value, $context = null)
    {
        return static::of($context)->setContainer($container)->setKey($key)->setValue($value);
    }
}
