<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 */
trait PriceSelectTrait
{
    /**
     * @param ParameterInterface $param
     * @return $this
     */
    abstract public function addParamObject(ParameterInterface $param);

    protected function select($key, $value)
    {
        if (!is_null($value)) {
            $this->addParamObject(new Parameter($key, $value));
        }

        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function currency($currency)
    {
        return $this->select('priceCurrency', $currency);
    }

    /**
     * @param string $country
     * @return $this
     */
    public function country($country)
    {
        return $this->select('priceCountry', $country);
    }

    /**
     * @param ChannelReference $channel
     * @return $this
     */
    public function channel(ChannelReference $channel)
    {
        return $this->select('priceChannel', $channel->getId());
    }

    /**
     * @param CustomerGroupReference $customerGroup
     * @return $this
     */
    public function customerGroup(CustomerGroupReference $customerGroup)
    {
        return $this->select('priceCustomerGroup', $customerGroup->getId());
    }
}
