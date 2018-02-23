<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractByIdGetRequest;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\States
 * @link https://docs.commercetools.com/http-api-projects-states.html#get-state-by-id
 * @method State mapResponse(ApiResponseInterface $response)
 * @method State mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class StateByIdGetRequest extends AbstractByIdGetRequest
{
    protected $resultClass = State::class;

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
