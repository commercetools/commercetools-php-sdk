<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\State;
use Sphere\Core\Model\State\StateDraft;
use Sphere\Core\Request\AbstractCreateRequest;

/**
 * Class StateCreateRequest
 * @package Sphere\Core\Request\States
 */
class StateCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\State\State';

    /**
     * @param StateDraft $state
     * @param Context $context
     */
    public function __construct(StateDraft $state, Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $state, $context);
    }
}
