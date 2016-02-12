<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://dev.commercetools.com/http-api-projects-types.html#money-type
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
