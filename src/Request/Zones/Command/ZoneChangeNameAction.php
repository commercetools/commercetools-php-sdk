<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Zones\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ZoneChangeNameAction
 * @package Sphere\Core\Request\Zones\Command
 * 
 * @method string getAction()
 * @method ZoneChangeNameAction setAction(string $action = null)
 * @method string getName()
 * @method ZoneChangeNameAction setName(string $name = null)
 */
class ZoneChangeNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeName');
    }


    /**
     * @param string $firstName
     * @param string $lastName
     * @param Context|callable $context
     * @return ZoneChangeNameAction
     */
    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
