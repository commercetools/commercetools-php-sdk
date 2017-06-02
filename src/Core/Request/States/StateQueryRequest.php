<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\State\StateCollection;
use Commercetools\Core\Request\AbstractQueryRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\States
 * @link https://dev.commercetools.com/http-api-projects-states.html#query-states
 * @method StateCollection mapResponse(ApiResponseInterface $response)
 * @method StateCollection mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StateQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = StateCollection::class;

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
