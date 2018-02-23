<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\States\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\States\Command
 * @link https://docs.commercetools.com/http-api-projects-states.html#set-state-name
 * @method string getAction()
 * @method StateSetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method StateSetNameAction setName(LocalizedString $name = null)
 */
class StateSetNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
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
    public static function ofName(LocalizedString $name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
