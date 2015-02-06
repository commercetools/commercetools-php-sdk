<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:43
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Model\Channel\ChannelReference;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;
use Sphere\Core\Model\OfTrait;

/**
 * Class Price
 * @package Sphere\Core\Model\Type
 * @method static Price of(Money $value)
 * @method Money getValue()
 * @method string getCountry()
 * @method string getCustomerGroup()
 * @method string getChannel()
 * @method string getDiscounted()
 * @method Price setValue(Money $value)
 * @method Price setCountry(string $country)
 * @method Price setCustomerGroup(CustomerGroupReference $customerGroup)
 * @method Price setChannel(ChannelReference $channel)
 * @method Price setDiscounted(DiscountedPrice $discountedPrice)
 */
class Price extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'value' => [self::TYPE => '\Sphere\Core\Model\Common\Money'],
            'country' => [self::TYPE => 'string'],
            'customerGroup' => [self::TYPE => '\Sphere\Core\Model\CustomerGroup\CustomerGroupReference'],
            'channel' => [self::TYPE => '\Sphere\Core\Model\Channel\ChannelReference'],
            'discounted' => [self::TYPE => '\Sphere\Core\Model\Common\DiscountedPrice'],
        ];
    }

    /**
     * @param Money $value
     */
    public function __construct(Money $value)
    {
        $this->setValue($value);
    }
}
