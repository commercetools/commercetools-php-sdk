<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateDraft;
use Sphere\Core\Request\AbstractCreateRequest;
use Sphere\Core\Model\State\State;
use Sphere\Core\Response\ApiResponseInterface;

/**
 * @package Sphere\Core\Request\States
 * @link http://dev.sphere.io/http-api-projects-states.html#create-state
 * @method State mapResponse(ApiResponseInterface $response)
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

    /**
     * @param StateDraft $state
     * @param Context $context
     * @return static
     */
    public static function ofDraft(StateDraft $state, Context $context = null)
    {
        return new static($state, $context);
    }
}
