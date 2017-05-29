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
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\Me
 * @link https://dev.commercetools.com/http-api-projects-me-profile.html#create-customer-sign-up
 * @method CustomerSigninResult mapResponse(ApiResponseInterface $response)
 * @method CustomerSigninResult mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class MeSignupRequest extends AbstractCreateRequest
{
    protected $resultClass = CustomerSigninResult::class;

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
