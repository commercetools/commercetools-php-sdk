<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateCollection;
use Sphere\Core\Request\AbstractQueryRequest;

class StatesQueryRequest extends AbstractQueryRequest
{
    /**
     * @param Context $context
     */
    public function __construct(Context $context = null)
    {
        parent::__construct(StatesEndpoint::endpoint(), $context);
    }

    /**
     * @param array $result
     * @param Context $context
     * @return StateCollection
     */
    public function mapResult(array $result, Context $context = null)
    {
        if (!empty($result['results'])) {
            return StateCollection::fromArray($result['results'], $context);
        }

        return new StateCollection([], $context);
    }
}
