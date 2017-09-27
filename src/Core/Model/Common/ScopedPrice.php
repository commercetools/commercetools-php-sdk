<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:43
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

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
 * @method ScopedPrice setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method ScopedPrice setValidUntil(DateTime $validUntil = null)
 * @method CustomFieldObject getCustom()
 * @method ScopedPrice setCustom(CustomFieldObject $custom = null)
 * @method Money getCurrentValue()
 * @method ScopedPrice setCurrentValue(Money $currentValue = null)
 */
class ScopedPrice extends JsonObject
{
    const ID = 'id';
    const VALUE = 'value';
    const CURRENT_VALUE = 'currentValue';
    const COUNTRY = 'country';
    const CUSTOMER_GROUP = 'customerGroup';
    const CHANNEL = 'channel';
    const VALID_FROM = 'validFrom';
    const VALID_UNTIL = 'validUntil';
    const DISCOUNTED = 'discounted';
    const CUSTOM = 'custom';

    public function fieldDefinitions()
    {
        return [
            static::ID => [static::TYPE => 'string'],
            static::VALUE => [self::TYPE => Money::class],
            static::CURRENT_VALUE => [static::TYPE => Money::class],
            static::COUNTRY => [self::TYPE => 'string'],
            static::CUSTOMER_GROUP => [self::TYPE => CustomerGroupReference::class],
            static::CHANNEL => [self::TYPE => ChannelReference::class],
            static::VALID_FROM => [
                self::TYPE => DateTime::class,
                self::DECORATOR => DateTimeDecorator::class
            ],
            static::VALID_UNTIL => [
                self::TYPE => DateTime::class,
                self::DECORATOR => DateTimeDecorator::class
            ],
            static::DISCOUNTED => [self::TYPE => DiscountedPrice::class],
            static::CUSTOM => [static::TYPE => CustomFieldObject::class],
        ];
    }

    /**
     * @param Money $money
     * @param Context|callable $context
     * @return ScopedPrice
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
