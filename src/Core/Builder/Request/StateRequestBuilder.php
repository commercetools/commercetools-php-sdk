<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Builder\Request;

use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\Request\States\StateByIdGetRequest;
use Commercetools\Core\Request\States\StateCreateRequest;
use Commercetools\Core\Request\States\StateDeleteRequest;
use Commercetools\Core\Request\States\StateQueryRequest;
use Commercetools\Core\Request\States\StateUpdateRequest;

class StateRequestBuilder
{
    /**
     * @return StateQueryRequest
     */
    public function query()
    {
        return StateQueryRequest::of();
    }

    /**
     * @param State $state
     * @return StateUpdateRequest
     */
    public function update(State $state)
    {
        return StateUpdateRequest::ofIdAndVersion($state->getId(), $state->getVersion());
    }

    /**
     * @param StateDraft $stateDraft
     * @return StateCreateRequest
     */
    public function create(StateDraft $stateDraft)
    {
        return StateCreateRequest::ofDraft($stateDraft);
    }

    /**
     * @param State $state
     * @return StateDeleteRequest
     */
    public function delete(State $state)
    {
        return StateDeleteRequest::ofIdAndVersion($state->getId(), $state->getVersion());
    }

    /**
     * @param string $id
     * @return StateByIdGetRequest
     */
    public function getById($id)
    {
        return StateByIdGetRequest::ofId($id);
    }
}
