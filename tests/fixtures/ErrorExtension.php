<?php
/** @noinspection PhpLanguageLevelInspection */
declare(strict_types=1);
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Fixtures;

use Commercetools\Core\IntegrationTests\ApiTestCase;
use PHPUnit\Runner\AfterTestErrorHook;
use PHPUnit\Runner\AfterTestFailureHook;

class ErrorExtension implements AfterTestErrorHook, AfterTestFailureHook
{
    public function executeAfterTestError(string $test, string $message, float $time): void
    {
        if (is_a($test, ApiTestCase::class, true)) {
            $test::flushErrorLog();
        }
    }

    public function executeAfterTestFailure(string $test, string $message, float $time): void
    {
        if (is_a($test, ApiTestCase::class, true)) {
            $test::flushErrorLog();
        }
    }
}
