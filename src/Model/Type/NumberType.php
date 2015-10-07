<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method NumberType setName(string $name = null)
 */
class NumberType extends FieldType
{
    const NAME = 'Number';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => 'float'];
    }
}
