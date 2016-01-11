<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods;

use Psr\Http\Message\ResponseInterface;
use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractApiRequest;
use Commercetools\Core\Response\PagedQueryResponse;
use Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\ShippingMethods
 *
 * @method ShippingMethodCollection mapResponse(ApiResponseInterface $response)
 */
class ShippingMethodByLocationGetRequest extends AbstractApiRequest
{
    protected $resultClass = '\Commercetools\Core\Model\ShippingMethod\ShippingMethodCollection';

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @param string $country
     * @param Context $context
     */
    public function __construct($country, Context $context = null)
    {
        parent::__construct(ShippingMethodsEndpoint::endpoint(), $context);
        $this->withCountry($country);
    }

    /**
     * @param string $country
     * @return $this
     */
    public function withCountry($country)
    {
        return $this->addParam('country', $country);
    }

    /**
     * @param string $state
     * @return $this
     */
    public function withState($state)
    {
        return $this->addParam('state', $state);
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function withCurrency($currency)
    {
        return $this->addParam('currency', $currency);
    }

    /**
     * @param string $country
     * @param Context $context
     * @return static
     */
    public static function ofCountry($country, Context $context = null)
    {
        return new static($country, $context);
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, $this->getPath());
    }

    /**
     * @param ResponseInterface $response
     * @return PagedQueryResponse
     */
    public function buildResponse(ResponseInterface $response)
    {
        return new PagedQueryResponse($response, $this, $this->getContext());
    }
}
