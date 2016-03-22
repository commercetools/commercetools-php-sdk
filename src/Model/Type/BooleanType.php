<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#boolean-type
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
