<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\Common\OfTrait;

/**
 * Class AbstractAction
 * @package Sphere\Core\Request
 * @method string getAction()
 * @method $this setAction(string $action)
 */
abstract class AbstractAction extends JsonObject
{
    use OfTrait;

    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string']
        ];
    }
}
