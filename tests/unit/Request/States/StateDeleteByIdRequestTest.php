<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\RequestTestCase;

class StateDeleteByIdRequestTest extends RequestTestCase
{
    const STATE_DELETE_BY_ID_REQUEST = '\Sphere\Core\Request\States\StateDeleteByIdRequest';

    public function testMapResult()
    {
        $result = $this->mapResult(static::STATE_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertInstanceOf('\Sphere\Core\Model\State\State', $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::STATE_DELETE_BY_ID_REQUEST, ['id', 1]);
        $this->assertNull($result);
    }
}
