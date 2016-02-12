<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\LocalizedEnumCollection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#localizable-enum-type
 * @method string getName()
 * @method LocalizedEnumType setName(string $name = null)
 * @method LocalizedEnumCollection getValues()
 * @method LocalizedEnumType setValues(LocalizedEnumCollection $values = null)
 */
class LocalizedEnumType extends AttributeType
{
    const NAME = 'lenum';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['values'] = [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedEnumCollection'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedEnum'];
    }
}
