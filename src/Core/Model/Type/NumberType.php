<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#numbertype
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
