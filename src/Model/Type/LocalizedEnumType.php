<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\LocalizedEnum;
use Commercetools\Core\Model\Common\LocalizedEnumCollection;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#localizedenumtype
 * @method string getName()
 * @method LocalizedEnumType setName(string $name = null)
 * @method LocalizedEnumCollection getValues()
 * @method LocalizedEnumType setValues(LocalizedEnumCollection $values = null)
 */
class LocalizedEnumType extends FieldType
{
    const NAME = 'LocalizedEnum';

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
