<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\States\Command
 * 
 * @method string getAction()
 * @method StateSetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method StateSetNameAction setName(LocalizedString $name = null)
 */
class StateSetNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setName');
    }

    /**
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return StateSetNameAction
     */
    public function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
