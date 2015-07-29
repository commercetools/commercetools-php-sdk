<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomerGroups\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\CustomerGroups\Command
 * 
 * @method string getAction()
 * @method CustomerGroupChangeNameAction setAction(string $action = null)
 * @method string getName()
 * @method CustomerGroupChangeNameAction setName(string $name = null)
 */
class CustomerGroupChangeNameAction extends AbstractAction
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
     * @param string $name
     * @param Context|callable $context
     * @return CustomerGroupChangeNameAction
     */
    public static function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
