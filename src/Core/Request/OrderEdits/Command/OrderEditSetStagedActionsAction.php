<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Request\OrderEdits\StagedOrder\Command\StagedOrderUpdateActionCollection;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method OrderEditSetStagedActionsAction setAction(string $action = null)
 * @method StagedOrderUpdateActionCollection getStagedActions()
 * @method OrderEditSetStagedActionsAction setStagedActions(StagedOrderUpdateActionCollection $stagedActions = null)
 */
class OrderEditSetStagedActionsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'stagedActions' => [static::TYPE => StagedOrderUpdateActionCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setStagedActions');
    }
}
