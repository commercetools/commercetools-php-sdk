<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

use PHPUnit\Framework\BaseTestListener;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;

class ErrorListener5 extends BaseTestListener
{
    public function addError(PHPUnit_Framework_Test $test, \Exception $e, $time)
    {
        if ($test instanceof ApiTestCase) {
            $test->flushErrorLog();
        }
        parent::addError($test, $e, $time);
    }

    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
        if ($test instanceof ApiTestCase) {
            $test->flushErrorLog();
        }
        parent::addFailure($test, $e, $time);
    }
}
