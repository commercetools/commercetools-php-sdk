<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#nestedtype
 * @method string getName()
 * @method NestedType setName(string $name = null)
 */
class NestedType extends AttributeType
{
    const NAME = 'nested';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'];
    }
}
