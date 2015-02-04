<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 04.02.15, 16:43
 */

namespace Sphere\Core\Model\Type;


use Sphere\Core\Model\Channel\ChannelReference;
use Sphere\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * Class Price
 * @package Sphere\Core\Model\Type
 * @method static Price of(Money $value)
 */
class Price extends JsonObject
{
    /**
     * @var Money
     */
    protected $value;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var CustomerGroupReference
     */
    protected $customerGroup;

    /**
     * @var ChannelReference
     */
    protected $channel;

    /**
     * @var DiscountedPrice
     */
    protected $discounted;

    public function __construct(Money $value)
    {
        $this->setValue($value);
    }


    /**
     * @return Money
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param Money $value
     * @return $this
     */
    public function setValue(Money $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return CustomerGroupReference
     */
    public function getCustomerGroup()
    {
        return $this->customerGroup;
    }

    /**
     * @param CustomerGroupReference $customerGroup
     * @return $this
     */
    public function setCustomerGroup(CustomerGroupReference $customerGroup)
    {
        $this->customerGroup = $customerGroup;

        return $this;
    }

    /**
     * @return ChannelReference
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param ChannelReference $channel
     * @return $this
     */
    public function setChannel(ChannelReference $channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @return DiscountedPrice
     */
    public function getDiscounted()
    {
        return $this->discounted;
    }

    /**
     * @param DiscountedPrice $discounted
     * @return $this
     */
    public function setDiscounted(DiscountedPrice $discounted)
    {
        $this->discounted = $discounted;

        return $this;
    }
}
