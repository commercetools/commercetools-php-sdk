<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Commons\Helper;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\Common\Price;
use Commercetools\Core\Model\Common\PriceCollection;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;

/**
 * @deprecated Please use the price selection functionality of Composable Commerce
 * @link http://docs.commercetools.com/http-api-projects-products.html#price-selection
 */
class PriceFinder
{
    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $country;

    /**
     * @var CustomerGroupReference
     */
    private $customerGroup;

    /**
     * @var ChannelReference
     */
    private $channel;

    /**
     * PriceFinder constructor.
     * @param string $currency
     * @param string $country
     * @param CustomerGroupReference $customerGroup
     * @param ChannelReference $channel
     */
    public function __construct(
        $currency,
        $country = null,
        CustomerGroupReference $customerGroup = null,
        ChannelReference $channel = null
    ) {
        $this->currency = $currency;
        $this->country = $country;
        $this->customerGroup = $customerGroup;
        $this->channel = $channel;
    }

    /**
     * @param PriceCollection $prices
     * @return Price
     */
    public function findPrice(PriceCollection $prices)
    {
        $currency = $this->currency;
        $country = $this->country;
        $customerGroup = $this->customerGroup;
        $channel = $this->channel;

        $prices = new \CallbackFilterIterator(
            $prices,
            function ($price) use ($currency, $country, $customerGroup, $channel) {
                if (!$this->priceHasCurrency($price, $currency)) {
                    return false;
                }
                if (!$this->priceHasNoDate($price) && !$this->priceHasValidDate($price, new \DateTime())) {
                    return false;
                }
                if (is_null($country)) {
                    if ($this->priceHas($price, 'country')) {
                        return false;
                    }
                } elseif (!$this->priceHasCountry($price, $country)) {
                    return false;
                }
                if (is_null($customerGroup)) {
                    if ($this->priceHas($price, 'customerGroup')) {
                        return false;
                    }
                } elseif (!$this->priceHasCustomerGroup($price, $customerGroup)) {
                    return false;
                }
                if (is_null($channel)) {
                    if ($this->priceHas($price, 'channel')) {
                        return false;
                    }
                } elseif (!$this->priceHasChannel($price, $channel)) {
                    return false;
                }
                return true;
            }
        );

        foreach ($prices as $price) {
            return $price;
        }
        return null;
    }

    /**
     * @param $prices
     * @param string $currency
     * @param string $country
     * @param CustomerGroupReference $customerGroup
     * @param ChannelReference $channel
     * @return Price|null
     */
    public static function findPriceFor(
        $prices,
        $currency,
        $country = null,
        CustomerGroupReference $customerGroup = null,
        ChannelReference $channel = null
    ) {
        $priceFinder = new static($currency, $country, $customerGroup, $channel);

        return $priceFinder->findPrice($prices);
    }

    /**
     * @param Price $price
     * @param string $currency
     * @return bool
     */
    private function priceHasCurrency(Price $price, $currency)
    {
        return !is_null($price->getValue()) && $price->getValue()->getCurrencyCode() == $currency;
    }

    /**
     * @param Price $price
     * @param string $country
     * @return bool
     */
    private function priceHasCountry(Price $price, $country)
    {
        return !is_null($price->getCountry()) && $price->getCountry() == $country;
    }

    /**
     * @param Price $price
     * @param CustomerGroupReference $customerGroup
     * @return bool
     */
    private function priceHasCustomerGroup(Price $price, CustomerGroupReference $customerGroup)
    {
        return !is_null($price->getCustomerGroup()) && $price->getCustomerGroup()->getId() == $customerGroup->getId();
    }

    /**
     * @param Price $price
     * @param ChannelReference $channel
     * @return bool
     */
    private function priceHasChannel(Price $price, ChannelReference $channel)
    {
        return !is_null($price->getChannel()) && $price->getChannel()->getId() == $channel->getId();
    }

    /**
     * @param Price $price
     * @param \DateTime $date
     * @return bool
     */
    private function priceHasValidDate(Price $price, \DateTime $date)
    {
        $tooEarly = !is_null($price->getValidFrom()) && $price->getValidFrom()->getDateTime() > $date;
        $tooLate = !is_null($price->getValidUntil()) && $price->getValidUntil()->getDateTime() < $date;
        return !$tooEarly && !$tooLate;
    }

    /**
     * @param Price $price
     * @return bool
     */
    private function priceHasNoDate(Price $price)
    {
        return is_null($price->getValidFrom()) && is_null($price->getValidUntil());
    }

    /**
     * @param Price $price
     * @param string $field
     * @return bool
     */
    private function priceHas(Price $price, $field)
    {
        return !is_null($price->get($field));
    }
}
