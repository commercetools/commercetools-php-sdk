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
 * @deprecated Please use the price selection functionality of the platform
 * @link http://dev.commercetools.com/http-api-projects-products.html#price-selection
 */
class PriceFinder
{
    private $currency;
    private $country;
    private $customerGroup;
    private $channel;

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
     * @param $currency
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

    private function priceHasCurrency(Price $price, $currency)
    {
        return !is_null($price->getValue()) && $price->getValue()->getCurrencyCode() == $currency;
    }

    private function priceHasCountry(Price $price, $country)
    {
        return !is_null($price->getCountry()) && $price->getCountry() == $country;
    }

    private function priceHasCustomerGroup(Price $price, CustomerGroupReference $customerGroup)
    {
        return !is_null($price->getCustomerGroup()) && $price->getCustomerGroup()->getId() == $customerGroup->getId();
    }

    private function priceHasChannel(Price $price, ChannelReference $channel)
    {
        return !is_null($price->getChannel()) && $price->getChannel()->getId() == $channel->getId();
    }

    private function priceHasValidDate(Price $price, \DateTime $date)
    {
        $tooEarly = !is_null($price->getValidFrom()) && $price->getValidFrom()->getDateTime() > $date;
        $tooLate = !is_null($price->getValidUntil()) && $price->getValidUntil()->getDateTime() < $date;
        return !$tooEarly && !$tooLate;
    }

    private function priceHasNoDate(Price $price)
    {
        return is_null($price->getValidFrom()) && is_null($price->getValidUntil());
    }

    private function priceHas(Price $price, $field)
    {
        return !is_null($price->get($field));
    }
}
