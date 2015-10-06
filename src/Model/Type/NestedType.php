<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method NestedType setName(string $name = null)
 */
class NestedType extends FieldType
{
    const NAME = 'Nested';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\AttributeCollection'];
    }
}
