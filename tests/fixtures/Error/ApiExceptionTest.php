<?php

namespace Commercetools\Core\Fixtures\Error;

use Commercetools\Core\Error\ApiException;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class ApiExceptionTest extends TestCase
{

    public function testIncompleteRequest()
    {
        $request = $this->createMock(Request::class);
        $e = ApiException::create($request, null);
        $this->assertSame(0, $e->getCode());
        $this->assertSame('Error completing request', $e->getMessage());
    }

    public function testIncompleteRequestWithPrevious()
    {
        $request = $this->createMock(Request::class);
        $previous = new \Exception("foo", 4);

        $e = ApiException::create($request, null, $previous);
        $this->assertSame(4, $e->getCode());
        $this->assertSame('Error completing request: foo', $e->getMessage());
    }
}
