<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:37
 */

namespace Sphere\Core\Error;


/**
 * Class Message
 * @package Sphere\Core\Error
 */
class Message
{
    const SETTER_NOT_IMPLEMENTED = 'Setter for key %s not implemented';
    const NO_CLIENT_ID = 'No client id set';
    const NO_CLIENT_SECRET = 'No client secret set';
    const NO_PROJECT_ID = 'No project id set';

    const INVALID_CACHE_ADAPTER = 'No valid CacheAdapterInterface found';

    const NO_KEY_GIVEN = 'No key given';

    const NO_VALUE_FOR_LOCALE = 'No value for locale set';

    const AUTHENTICATION_FAIL = 'Authentication failed: %s';

    const UNKNOWN_METHOD = 'Unknown method: %s (unknown field: %s)';
    const UNKNOWN_FIELD = 'Unknown field: "%s" - called: %s(%s)';
    const WRONG_TYPE = 'Wrong type for field "%s". Expected %s.';
    const EXPECTS_PARAMETER = 'Excepts parameter "%s" to be %s, null given.';

    const NO_LANGUAGES_PROVIDED = 'No languages provided';

    const DEPRECATED_METHOD = 'Call "%s" with method "%s" is deprecated: "%s"';
}
