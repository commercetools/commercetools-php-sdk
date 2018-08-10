<?php

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Request\States\StateByIdGetRequest;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Model\State\State;
use Commercetools\Core\Request\States\StateQueryRequest;
use Commercetools\Core\Request\States\StateUpdateRequest;

class StateRequestBuilder
{

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#get-state-by-id
     * @param string $id
     * @return StateByIdGetRequest
     */
    public function getById($id)
    {
        $request = StateByIdGetRequest::ofId($id);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#create-state
     * @param StateDraft $state
     * @return StateCreateRequest
     */
    public function create(StateDraft $state)
    {
        $request = StateCreateRequest::ofDraft($state);
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#delete-state
     * @param State $state
     * @return StateDeleteRequest
     */
    public function delete(State $state)
    {
        $request = StateDeleteRequest::ofIdAndVersion($state->getId(), $state->getVersion());
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#query-states
     * @param 
     * @return StateQueryRequest
     */
    public function query()
    {
        $request = StateQueryRequest::of();
        return $request;
    }

    /**
     * @link https://docs.commercetools.com/http-api-projects-states.html#update-state
     * @param State $state
     * @return StateUpdateRequest
     */
    public function update(State $state)
    {
        $request = StateUpdateRequest::ofIdAndVersion($state->getId(), $state->getVersion());
        return $request;
    }

    /**
     * @return StateRequestBuilder
     */
    public function of()
    {
        return new self();
    }
}
