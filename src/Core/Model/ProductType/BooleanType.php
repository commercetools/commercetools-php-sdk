<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#booleantype
 * @method string getName()
 * @method BooleanType setName(string $name = null)
 */
class BooleanType extends AttributeType
{
    const NAME = 'boolean';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => 'bool'];
    }
}
