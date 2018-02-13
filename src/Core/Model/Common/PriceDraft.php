<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;
use DateTime;

/**
 * @package Commercetools\Core\Model\Common
 * @link https://docs.commercetools.com/http-api-projects-products.html#pricedraft
 * @method Money getValue()
 * @method PriceDraft setValue(Money $value = null)
 * @method string getCountry()
 * @method PriceDraft setCountry(string $country = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method PriceDraft setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method ChannelReference getChannel()
 * @method PriceDraft setChannel(ChannelReference $channel = null)
 * @method DateTimeDecorator getValidFrom()
 * @method PriceDraft setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method PriceDraft setValidUntil(DateTime $validUntil = null)
 * @method CustomFieldObject getCustom()
 * @method PriceDraft setCustom(CustomFieldObject $custom = null)
 * @method PriceTierCollection getTiers()
 * @method PriceDraft setTiers(PriceTierCollection $tiers = null)
 */
class PriceDraft extends JsonObject
{
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
            static::VALUE => [self::TYPE => Money::class],
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
            static::CUSTOM => [static::TYPE => CustomFieldObject::class],
            static::TIERS => [static::TYPE => PriceTierCollection::class]
        ];
    }

    /**
     * @param Money $money
     * @param Context|callable $context
     * @return PriceDraft
     */
    public static function ofMoney(Money $money, $context = null)
    {
        $price = static::of($context);
        return $price->setValue($money);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getValue()->__toString();
    }
}
