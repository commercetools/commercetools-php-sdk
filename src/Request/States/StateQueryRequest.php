<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\State\StateCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\States
 * @apidoc http://dev.sphere.io/http-api-projects-states.html#states-by-query
 * @method StateCollection mapResponse(ApiResponseInterface $response)
 */
class StateQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Commercetools\Core\Model\State\StateCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $context);
    }

    /**
     * @param Context $context
     * @return static
     */
    public static function of(Context $context = null)
    {
        return new static($context);
    }
}
