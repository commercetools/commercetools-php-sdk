<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateCollection;
use Sphere\Core\Request\AbstractQueryRequest;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\States
 * @link http://dev.sphere.io/http-api-projects-states.html#states-by-query
 * @method StateCollection mapResponse(ApiResponseInterface $response)
 */
class StateQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\State\StateCollection';

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
