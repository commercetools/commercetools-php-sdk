<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:37
 */

namespace Commercetools\Core\Error;

/**
 * @package Commercetools\Core\Error
 */
class Message
{
    const SETTER_NOT_IMPLEMENTED = 'Setter for key %s not implemented';
    const NO_CLIENT_ID = 'No client id set';
    const NO_CLIENT_SECRET = 'No client secret set';
    const NO_PROJECT_ID = 'No project id set';

    const INVALID_CACHE_ADAPTER = 'No valid CacheAdapter found';

    const NO_KEY_GIVEN = 'No key given';

    const NO_VALUE_FOR_LOCALE = 'No value for locale set';

    const AUTHENTICATION_FAIL = 'Authentication failed: %s';

    const UNKNOWN_METHOD = 'Unknown method: %s';
    const UNKNOWN_FIELD = 'Unknown field: "%s" - called: %s(%s)';
    const WRONG_TYPE = 'Wrong type for field "%s". Expected %s.';
    const WRONG_ARGUMENT_TYPE = 'Wrong type for argument "%s". Expected %s.';
    const EXPECTS_PARAMETER = 'Excepts parameter "%s" to be %s, null given.';

    const NO_LANGUAGES_PROVIDED = 'No languages provided';

    const DEPRECATED_METHOD = 'Call "%s" with method "%s" is deprecated: "%s"';
    const FUTURE_BAD_METHOD_CALL = 'Trying to call a function for a non future request';

    const UPDATE_ACTION_LIMIT_WARNING = 'Update call %s has over %s update actions.';
    const UPDATE_ACTION_LIMIT = 'Update call %s over limit of %s update actions.';
}
