<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CartDiscount;

use Commercetools\Core\Model\Common\MoneyCollection;

/**
 * @package Commercetools\Core\Model\CartDiscount
 *
 * @method string getType()
 * @method AbsoluteCartDiscountValue setType(string $type = null)
 * @method MoneyCollection getMoney()
 * @method AbsoluteCartDiscountValue setMoney(MoneyCollection $money = null)
 */
class AbsoluteCartDiscountValue extends CartDiscountValue
{
    /**
     * @inheritDoc
     */
    public function __construct(array $data = [], $context = null)
    {
        $data['type'] = static::TYPE_ABSOLUTE;

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
     * @deprecated getPermyriad will be removed for absolute cart discounts with v3.0
     * @return int
     */
    public function getPermyriad()
    {
        return parent::getPermyriad();
    }
    /**
     * @deprecated setPermyriad will be removed for absolute cart discounts with v3.0
     * @param int $permyriad
     * @return AbsoluteCartDiscountValue
     */
    public function setPermyriad($permyriad = null)
    {
        return parent::setPermyriad($permyriad);
    }
}
