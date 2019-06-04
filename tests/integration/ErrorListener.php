<?php
/** @noinspection PhpLanguageLevelInspection */
declare(strict_types=1);
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;

class ErrorListener implements TestListener
{
    use TestListenerDefaultImplementation;

    public function addError(Test $test, \Throwable $t, float $time): void
    {
        if ($test instanceof ApiTestCase) {
            $test->flushErrorLog();
        }
    }

    public function addFailure(Test $test, AssertionFailedError $e, float $time): void
    {
        if ($test instanceof ApiTestCase) {
            $test->flushErrorLog();
        }
    }
}
