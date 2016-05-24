<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:43
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://dev.commercetools.com/http-api-projects-products.html#scopedprice
 * @method Money getValue()
 * @method string getCountry()
 * @method CustomerGroupReference getCustomerGroup()
 * @method ChannelReference getChannel()
 * @method DiscountedPrice getDiscounted()
 * @method ScopedPrice setValue(Money $value = null)
 * @method ScopedPrice setCountry(string $country = null)
 * @method ScopedPrice setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method ScopedPrice setChannel(ChannelReference $channel = null)
 * @method ScopedPrice setDiscounted(DiscountedPrice $discounted = null)
 * @method string getId()
 * @method ScopedPrice setId(string $id = null)
 * @method DateTimeDecorator getValidFrom()
 * @method ScopedPrice setValidFrom(\DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method ScopedPrice setValidUntil(\DateTime $validUntil = null)
 * @method CustomFieldObject getCustom()
 * @method ScopedPrice setCustom(CustomFieldObject $custom = null)
 * @method Money getCurrentValue()
 * @method ScopedPrice setCurrentValue(Money $currentValue = null)
 */
class ScopedPrice extends Price
{
    const CURRENT_VALUE = 'currentValue';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions[static::CURRENT_VALUE] = [static::TYPE => '\Commercetools\Core\Model\Common\Money'];

        return $definitions;
    }

    /**
     * @param Money $money
     * @param Context|callable $context
     * @return Price
     */
    public static function ofMoney(Money $money, $context = null)
    {
        $price = static::of($context);
        return $price->setValue($money);
    }

    public function __toString()
    {
        return $this->getCurrentValue()->__toString();
    }
}
