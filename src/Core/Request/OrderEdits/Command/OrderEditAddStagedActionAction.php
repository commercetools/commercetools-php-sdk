<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\OrderEdits\Command
 *
 * @method string getAction()
 * @method OrderEditAddStagedActionAction setAction(string $action = null)
 * @method StagedOrderUpdateAction getStagedAction()
 * @method OrderEditAddStagedActionAction setStagedAction(StagedOrderUpdateAction $stagedAction = null)
 */
class OrderEditAddStagedActionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'stagedAction' => [static::TYPE => StagedOrderUpdateAction::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addStagedAction');
    }

}
