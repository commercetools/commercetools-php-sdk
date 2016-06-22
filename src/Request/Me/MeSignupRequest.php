<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Me;

use Commercetools\Core\Client\HttpMethod;
use Commercetools\Core\Client\HttpRequest;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Customer\CustomerSigninResult;
use Commercetools\Core\Model\Customer\MyCustomerDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 */
class MeSignupRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Customer\CustomerSigninResult';

    /**
     * MeGetRequest constructor.
     * @param MyCustomerDraft $customer
     * @param Context $context
     */
    public function __construct(MyCustomerDraft $customer, Context $context = null)
    {
        parent::__construct(MeEndpoint::endpoint(), $customer, $context);
    }

    /**
     * @param MyCustomerDraft $customer
     * @param Context $context
     * @return static
     */
    public static function ofCustomer(MyCustomerDraft $customer, Context $context = null)
    {
        return new static($customer, $context);
    }

    /**
     * @return HttpRequest
     * @internal
     */
    public function httpRequest()
    {
        return new HttpRequest(
            HttpMethod::POST,
            (string)$this->getEndpoint() . '/signup' . $this->getParamString(),
            $this->getObject()
        );
    }
}
