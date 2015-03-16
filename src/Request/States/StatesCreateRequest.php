<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\State;
use Sphere\Core\Model\State\StateDraft;
use Sphere\Core\Request\AbstractCreateRequest;

class StatesCreateRequest extends AbstractCreateRequest
{
    /**
     * @param StateDraft $state
     * @param Context $context
     */
    public function __construct(StateDraft $state, Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $state, $context);
    }

    /**
     * @param array $result
     * @param Context $context
     * @return State|null
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result)) {
            return State::fromArray($result, $context);
        }
        return null;
    }
}
