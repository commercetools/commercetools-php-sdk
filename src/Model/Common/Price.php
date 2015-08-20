<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:43
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * @package Commercetools\Core\Model\Common
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#product-price
 * @method Money getValue()
 * @method string getCountry()
 * @method CustomerGroupReference getCustomerGroup()
 * @method ChannelReference getChannel()
 * @method DiscountedPrice getDiscounted()
 * @method Price setValue(Money $value = null)
 * @method Price setCountry(string $country = null)
 * @method Price setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method Price setChannel(ChannelReference $channel = null)
 * @method Price setDiscounted(DiscountedPrice $discounted = null)
 * @method string getId()
 * @method Price setId(string $id = null)
 * @method DateTimeDecorator getValidFrom()
 * @method Price setValidFrom(\DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method Price setValidUntil(\DateTime $validUntil = null)
 */
class Price extends JsonObject
{
    const ID = 'id';
    const VALUE = 'value';
    const COUNTRY = 'country';
    const CUSTOMER_GROUP = 'customerGroup';
    const CHANNEL = 'channel';
    const VALID_FROM = 'validFrom';
    const VALID_UNTIL = 'validUntil';
    const DISCOUNTED = 'discounted';

    public function fieldDefinitions()
    {
        return [
            static::ID => [static::TYPE => 'string'],
            static::VALUE => [self::TYPE => '\Commercetools\Core\Model\Common\Money'],
            static::COUNTRY => [self::TYPE => 'string'],
            static::CUSTOMER_GROUP => [self::TYPE => '\Commercetools\Core\Model\CustomerGroup\CustomerGroupReference'],
            static::CHANNEL => [self::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            static::VALID_FROM => [
                self::TYPE => '\DateTime',
                self::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            static::VALID_UNTIL => [
                self::TYPE => '\DateTime',
                self::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            static::DISCOUNTED => [self::TYPE => '\Commercetools\Core\Model\Common\DiscountedPrice'],
        ];
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
        return $this->getValue()->__toString();
    }
}
