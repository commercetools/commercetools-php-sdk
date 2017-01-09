<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\ProductType;

use Commercetools\Core\Model\Common\Money;

/**
 * @package Commercetools\Core\Model\ProductType
 * @link https://dev.commercetools.com/http-api-projects-productTypes.html#moneytype
 * @method string getName()
 * @method MoneyType setName(string $name = null)
 */
class MoneyType extends AttributeType
{
    const NAME = 'money';

    public function fieldTypeDefinition()
    {
        return [static::TYPE => Money::class];
    }
}
