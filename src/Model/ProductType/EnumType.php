<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\EnumCollection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#enumtype
 * @method string getName()
 * @method EnumType setName(string $name = null)
 * @method EnumCollection getValues()
 * @method EnumType setValues(EnumCollection $values = null)
 */
class EnumType extends AttributeType
{
    const NAME = 'enum';

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
