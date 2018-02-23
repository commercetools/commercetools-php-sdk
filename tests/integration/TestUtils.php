<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core;

class TestUtils
{
    public static function randomString()
    {
        return 'random-string-' . ((int)rand() * 100000) . '-'. time();
    }
}
