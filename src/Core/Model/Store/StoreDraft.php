<?php
/**
 */

namespace Commercetools\Core\Model\Store;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Store
 * @link https://docs.commercetools.com/http-api-projects-stores#storedraft
 *
 * @method string getKey()
 * @method StoreDraft setKey(string $key = null)
 * @method LocalizedString getName()
 * @method StoreDraft setName(LocalizedString $name = null)
 */
class StoreDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'key' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return StoreDraft
     */
    public static function ofKey($key, Context $context)
    {
        return static::of($context)->setKey($key);
    }
}
