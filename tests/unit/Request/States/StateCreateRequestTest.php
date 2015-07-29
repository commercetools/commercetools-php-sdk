<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\Model\State\StateDraft;
use Sphere\Core\RequestTestCase;

class StateCreateRequestTest extends RequestTestCase
{
    const STATE_CREATE_REQUEST = '\Sphere\Core\Request\States\StateCreateRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(StateCreateRequest::ofDraft(StateDraft::fromArray(['key' => 'myTestState'])));
        $this->assertInstanceOf('\Sphere\Core\Model\State\State', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(StateCreateRequest::ofDraft(StateDraft::fromArray(['key' => 'myTestState'])));
        $this->assertNull($result);
    }
}
