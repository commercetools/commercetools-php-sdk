<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @method $this addParamObject(ParameterInterface $param)
 */
trait PriceTrait
{

    protected function priceSelect($key, $value)
    {
        if (!is_null($value)) {
            $this->addParamObject(new Parameter('price.' . $key, $value));
        }

        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function priceCurrency($currency)
    {
        return $this->priceSelect('currency', $currency);
    }

    /**
     * @param string $country
     * @return $this
     */
    public function priceCountry($country)
    {
        return $this->priceSelect('country', $country);
    }

    /**
     * @param ChannelReference $channel
     * @return $this
     */
    public function priceChannel(ChannelReference $channel)
    {
        return $this->priceSelect('channel', $channel->getId());
    }

    /**
     * @param CustomerGroupReference $customerGroup
     * @return $this
     */
    public function priceCustomerGroup(CustomerGroupReference $customerGroup)
    {
        return $this->priceSelect('customerGroup', $customerGroup->getId());
    }
}
