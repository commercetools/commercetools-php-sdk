<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;


/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method BooleanType setName(string $name = null)
 */
class BooleanType extends FieldType
{
    const NAME = 'Boolean';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => 'bool'];
    }
}
