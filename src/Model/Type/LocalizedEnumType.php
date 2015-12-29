<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\LocalizedEnumCollection;

/**
 * @package Commercetools\Core\Model\Type
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
        $definitions['values'] = [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedEnumCollection'];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedEnum'];
    }
}
