<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Model\State\State;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * Class StateFetchByIdRequest
 * @package Sphere\Core\Request\States
 * @link http://dev.sphere.io/http-api-projects-states.html#states-by-id
 * @method State mapResponse(ApiResponseInterface $response)
 */
class StateFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\State\State';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $id, $context);
    }

    /**
     * @param string $id
     * @param Context $context
     * @return static
     */
    public static function ofId($id, Context $context = null)
    {
        return new static($id, $context);
    }
}
