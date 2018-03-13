<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Message;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Model\Message
 *
 * @method bool getEnabled()
 * @method MessagesConfiguration setEnabled(bool $enabled = null)
 */
class MessagesConfiguration extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'enabled' => [static::TYPE => 'bool'],
        ];
    }
}
