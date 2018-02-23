<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-projects-types.html#moneytype
 * @method string getName()
 * @method MoneyType setName(string $name = null)
 */
class MoneyType extends FieldType
{
    const NAME = 'Money';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => Money::class];
    }
}
