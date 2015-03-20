<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateCollection;
use Sphere\Core\Request\AbstractQueryRequest;

/**
 * Class StatesQueryRequest
 * @package Sphere\Core\Request\States
 */
class StatesQueryRequest extends AbstractQueryRequest
{
    protected $resultClass = '\Sphere\Core\Model\State\StateCollection';

    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $context);
    }
}
