<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\MoneyCollection;

/**
 * @package Commercetools\Core\Model\CartDiscount
 * @method string getType()
 * @method RelativeCartDiscountValue setType(string $type = null)
 * @method int getPermyriad()
 * @method RelativeCartDiscountValue setPermyriad(int $permyriad = null)
 */
class RelativeCartDiscountValue extends CartDiscountValue
{
    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        $data['type'] = static::TYPE_RELATIVE;

        parent::__construct($data, $context);
    }

    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => 'string'],
            'permyriad' => [static::TYPE => 'int'],
            'money' => [static::TYPE => MoneyCollection::class]
        ];
    }

    /**
     * @deprecated getMoney will be removed for relative cart discounts with v3.0
     * @return MoneyCollection
     */
    public function getMoney()
    {
        return parent::getMoney();
    }

    /**
     * @deprecated setMoney will be removed for relative cart discounts with v3.0
     * @param MoneyCollection|null $money
     * @return CartDiscountValue
     */
    public function setMoney(MoneyCollection $money = null)
    {
        return parent::setMoney($money);
    }
}
