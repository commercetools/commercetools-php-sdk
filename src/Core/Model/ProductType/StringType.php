<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#texttype
 * @method string getName()
 * @method StringType setName(string $name = null)
 */
class StringType extends AttributeType
{
    const NAME = 'text';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => 'string'];
    }
}
