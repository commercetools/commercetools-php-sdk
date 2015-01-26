<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:37
 */

namespace Sphere\Core\Error;


class Message {

    const SETTER_NOT_IMPLEMENTED = 'Setter for key %s not implemented';
    const NO_CLIENT_ID = 'No client id set';
    const NO_CLIENT_SECRET = 'No client secret set';
    const NO_PROJECT_ID = 'No project id set';

    const INVALID_CACHE_ADAPTER = 'No valid CacheAdapterInterface found';

    const NO_KEY_GIVEN = 'No key given';

    const NO_VALUE_FOR_LOCALE = 'No value for locale set';

    const AUTHENTICATION_FAIL = 'Authentication failed: %s';
}
