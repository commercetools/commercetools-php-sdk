<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractDeleteByIdRequest;

/**
 * Class StateDeleteByIdRequest
 * @package Sphere\Core\Request\States
 * @link http://dev.sphere.io/http-api-projects-states.html#delete-state
 */
class StateDeleteByIdRequest extends AbstractDeleteByIdRequest
{
    protected $resultClass = '\Sphere\Core\Model\State\State';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $id, $version, $context);
    }
}
