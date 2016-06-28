<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\EnumCollection;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#enumtype
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
        $definitions['values'] = [static::TYPE => '\Commercetools\Core\Model\Common\EnumCollection'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\Enum'];
    }
}
