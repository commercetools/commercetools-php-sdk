<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\State\StateReference;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 *
 * @method string getAction()
 * @method TransitionStateAction setAction(string $action = null)
 * @method StateReference getState()
 * @method TransitionStateAction setState(StateReference $state = null)
 * @method bool getForce()
 * @method TransitionStateAction setForce(bool $force = null)
 */
class TransitionStateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'state' => [static::TYPE => '\Commercetools\Core\Model\State\StateReference'],
            'force' =>  [static::TYPE => 'bool']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('transitionState');
    }

    /**
     * @param StateReference $state
     * @param Context|callable $context
     * @return static
     */
    public static function ofState(StateReference $state, $context = null)
    {
        return static::of($context)->setState($state);
    }
}
