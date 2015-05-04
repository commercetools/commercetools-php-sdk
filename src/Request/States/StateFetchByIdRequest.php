<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractFetchByIdRequest;

/**
 * Class StateFetchByIdRequest
 * @package Sphere\Core\Request\States
 * @link http://dev.sphere.io/http-api-projects-states.html#states-by-id
 */
class StateFetchByIdRequest extends AbstractFetchByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\Common\JsonObject';

    /**
     * @param string $id
     * @param Context $context
     */
    public function __construct($id, Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $id, $context);
    }
}
