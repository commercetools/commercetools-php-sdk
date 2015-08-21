<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;


/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method EnumType setName(string $name = null)
 * @method getValues()
 * @method EnumType setValues($values = null)
 */
class EnumType extends FieldType
{
    const NAME = 'Enum';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['values'] = [static::TYPE => ''];

        return $definitions;
    }

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\EnumCollection'];
    }
}
