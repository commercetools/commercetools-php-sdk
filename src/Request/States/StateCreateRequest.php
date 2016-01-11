<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\States
 * @apidoc http://dev.sphere.io/http-api-projects-states.html#create-state
 * @method State mapResponse(ApiResponseInterface $response)
 */
class StateCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Commercetools\Core\Model\State\State';

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
