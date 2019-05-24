<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\IntegrationTests;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\BaseTestListener;
use PHPUnit\Framework\Test;

class ErrorListener extends BaseTestListener
{
    public function addError(Test $test, \Exception $e, $time)
    {
        if ($test instanceof ApiTestCase) {
            $test->flushErrorLog();
        }
        parent::addError($test, $e, $time);
    }

    public function addFailure(Test $test, AssertionFailedError $e, $time)
    {
        if ($test instanceof ApiTestCase) {
            $test->flushErrorLog();
        }
        parent::addFailure($test, $e, $time);
    }
}
