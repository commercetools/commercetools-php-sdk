<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://docs.commercetools.com/http-api-projects-productTypes.html#localizableenumtype
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
        $definitions['values'] = [static::TYPE => LocalizedEnumCollection::class];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => LocalizedEnum::class];
    }
}
