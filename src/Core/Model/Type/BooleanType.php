<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#booleantype
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
