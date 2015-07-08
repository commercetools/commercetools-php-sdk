<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\States\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\State\StateReferenceCollection;
use Sphere\Core\Request\AbstractAction;

/**
 * Class StateSetTransitionsAction
 * @package Sphere\Core\Request\States\Command
 * 
 * @method string getAction()
 * @method StateSetTransitionsAction setAction(string $action = null)
 * @method StateReferenceCollection getTransitions()
 * @method StateSetTransitionsAction setTransitions(StateReferenceCollection $transitions = null)
 */
class StateSetTransitionsAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'transitions' => [static::TYPE => '\Sphere\Core\Model\State\StateReferenceCollection'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setTransitions');
    }

    /**
     * @param StateReferenceCollection $transitions
     * @param Context|callable $context
     * @return StateSetTransitionsAction
     */
    public function ofTransitions(StateReferenceCollection $transitions, $context = null)
    {
        return static::of($context)->setTransitions($transitions);
    }
}
