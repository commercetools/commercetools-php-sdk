<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

/**
 * @package Commercetools\Core\Model\ProductType
 * @method string getName()
 * @method NumberType setName(string $name = null)
 */
class NumberType extends AttributeType
{
    const NAME = 'number';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => 'float'];
    }
}
