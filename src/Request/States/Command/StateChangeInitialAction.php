<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class StateChangeInitialAction
 * @package Sphere\Core\Request\States\Command
 * 
 * @method string getAction()
 * @method StateChangeInitialAction setAction(string $action = null)
 * @method bool getInitial()
 * @method StateChangeInitialAction setInitial(bool $initial = null)
 */
class StateChangeInitialAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'initial' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeInitial');
    }

    /**
     * @param bool $initial
     * @param Context|callable $context
     * @return StateChangeInitialAction
     */
    public function ofInitial($initial, $context = null)
    {
        return static::of($context)->setInitial($initial);
    }
}
