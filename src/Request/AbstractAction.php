<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Common\JsonObject;

/**
 * @package Commercetools\Core\Request
 * @method string getAction()
 * @method $this setAction(string $action)
 */
abstract class AbstractAction extends JsonObject
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string']
        ];
    }
}
