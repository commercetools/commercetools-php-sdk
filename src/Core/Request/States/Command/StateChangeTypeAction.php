<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 * @link https://dev.commercetools.com/http-api-projects-states.html#change-state-type
 * @method string getAction()
 * @method StateChangeTypeAction setAction(string $action = null)
 * @method string getType()
 * @method StateChangeTypeAction setType(string $type = null)
 */
class StateChangeTypeAction extends AbstractAction
{
    public function fieldDefinitions()
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
    public static function ofType($type, $context = null)
    {
        return static::of($context)->setType($type);
    }
}
