<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\States\Command
 * 
 * @method string getAction()
 * @method StateChangeTypeAction setAction(string $action = null)
 * @method string getType()
 * @method StateChangeTypeAction setType(string $type = null)
 */
class StateChangeTypeAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeType');
    }

    /**
     * @param string $type
     * @param Context|callable $context
     * @return StateChangeTypeAction
     */
    public function ofType($type, $context = null)
    {
        return static::of($context)->setType($type);
    }
}
