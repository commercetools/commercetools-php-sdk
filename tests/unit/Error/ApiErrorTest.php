<?php

namespace Commercetools\Core\Error;

use Commercetools\Core\Error\ApiError;
use PHPUnit\Framework\MockObject\Api;
use PHPUnit\Framework\TestCase;

class ApiErrorTest extends TestCase
{
    /**
     * @dataProvider getErrors
     */
    public function testErrorCodes($errorJson, $expectedClass)
    {
        $error = ApiError::fromArray(json_decode($errorJson, true));

        $this->assertInstanceOf($expectedClass, $error);
    }

    public function getErrors()
    {
        return [
            LanguageUsedInStoresError::CODE => ['{"code": "LanguageUsedInStores"}', LanguageUsedInStoresError::class]
        ];
    }
}
