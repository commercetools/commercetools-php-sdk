<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

use Sphere\Core\Model\Common\JsonObject;

/**
 * @package Sphere\Core\Request
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
