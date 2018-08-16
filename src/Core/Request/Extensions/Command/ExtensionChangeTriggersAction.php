<?php
/**
 */

namespace Commercetools\Core\Request\Extensions\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Extension\TriggerCollection;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Extensions\Command
 * @link https://docs.commercetools.com/http-api-projects-api-extensions.html#change-triggers
 * @method string getAction()
 * @method ExtensionChangeTriggersAction setAction(string $action = null)
 * @method TriggerCollection getTriggers()
 * @method ExtensionChangeTriggersAction setTriggers(TriggerCollection $triggers = null)
 */
class ExtensionChangeTriggersAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'triggers' => [static::TYPE => TriggerCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeTriggers');
    }
}
