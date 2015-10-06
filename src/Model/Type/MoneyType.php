<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @method string getName()
 * @method MoneyType setName(string $name = null)
 */
class MoneyType extends FieldType
{
    const NAME = 'Money';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => '\Commercetools\Core\Model\Common\Money'];
    }
}
