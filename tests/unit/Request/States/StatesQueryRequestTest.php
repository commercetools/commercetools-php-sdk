<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States;


use Sphere\Core\RequestTestCase;

/**
 * Class StatesQueryRequestTest
 * @package Sphere\Core\Request\States
 */
class StatesQueryRequestTest extends RequestTestCase
{
    const STATES_QUERY_REQUEST = '\Sphere\Core\Request\States\StatesQueryRequest';

    public function testMapResult()
    {
        $result = $this->mapQueryResult(static::STATES_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\State\StateCollection', $result);
        $this->assertCount(3, $result);
    }

    public function testMapEmptyResult()
    {
        $result = $this->mapEmptyResult(static::STATES_QUERY_REQUEST);
        $this->assertInstanceOf('\Sphere\Core\Model\State\StateCollection', $result);
    }
}
