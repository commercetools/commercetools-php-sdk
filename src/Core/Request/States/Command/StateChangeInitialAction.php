<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 * @link https://docs.commercetools.com/http-api-projects-states.html#change-initial-state
 * @method string getAction()
 * @method StateChangeInitialAction setAction(string $action = null)
 * @method bool getInitial()
 * @method StateChangeInitialAction setInitial(bool $initial = null)
 */
class StateChangeInitialAction extends AbstractAction
{
    public function fieldDefinitions()
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
    public static function ofInitial($initial, $context = null)
    {
        return static::of($context)->setInitial($initial);
    }
}
