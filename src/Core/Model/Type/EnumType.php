<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Enum;
use Commercetools\Core\Model\Common\EnumCollection;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#enumtype
 * @method string getName()
 * @method EnumType setName(string $name = null)
 * @method EnumCollection getValues()
 * @method EnumType setValues(EnumCollection $values = null)
 */
class EnumType extends FieldType
{
    const NAME = 'Enum';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['values'] = [static::TYPE => EnumCollection::class];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => Enum::class];
    }
}
