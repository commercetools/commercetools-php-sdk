<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:43
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#price
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
 * @method Price setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method Price setValidUntil(DateTime $validUntil = null)
 * @method CustomFieldObject getCustom()
 * @method Price setCustom(CustomFieldObject $custom = null)
 * @method PriceTierCollection getTiers()
 * @method Price setTiers(PriceTierCollection $tiers = null)
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
    const CUSTOM = 'custom';
    const TIERS = 'tiers';

    public function fieldDefinitions()
    {
        return [
            static::ID => [static::TYPE => 'string'],
            static::VALUE => [self::TYPE => Money::class],
            static::COUNTRY => [self::TYPE => 'string', static::OPTIONAL => true],
            static::CUSTOMER_GROUP => [self::TYPE => CustomerGroupReference::class, static::OPTIONAL => true],
            static::CHANNEL => [self::TYPE => ChannelReference::class, static::OPTIONAL => true],
            static::VALID_FROM => [
                self::TYPE => DateTime::class,
                static::OPTIONAL => true,
                self::DECORATOR => DateTimeDecorator::class
            ],
            static::VALID_UNTIL => [
                self::TYPE => DateTime::class,
                static::OPTIONAL => true,
                self::DECORATOR => DateTimeDecorator::class
            ],
            static::DISCOUNTED => [self::TYPE => DiscountedPrice::class, static::OPTIONAL => true],
            static::CUSTOM => [static::TYPE => CustomFieldObject::class, static::OPTIONAL => true],
            static::TIERS => [static::TYPE => PriceTierCollection::class, static::OPTIONAL => true]
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

    /**
     * @return Money
     */
    public function getCurrentValue()
    {
        if ($this->getDiscounted() instanceof DiscountedPrice) {
            return $this->getDiscounted()->getValue();
        }

        return $this->getValue();
    }
}
