<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States;

use Commercetools\Core\Model\State\State;
use Commercetools\Core\Model\State\StateDraft;
use Commercetools\Core\RequestTestCase;

class StateCreateRequestTest extends RequestTestCase
{
    const STATE_CREATE_REQUEST = '\Commercetools\Core\Request\States\StateCreateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(StateCreateRequest::ofDraft(StateDraft::fromArray(['key' => 'myTestState'])));
        $this->assertInstanceOf(State::class, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(StateCreateRequest::ofDraft(StateDraft::fromArray(['key' => 'myTestState'])));
        $this->assertNull($result);
    }
}
