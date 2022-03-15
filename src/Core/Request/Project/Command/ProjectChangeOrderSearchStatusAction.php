<?php

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Project\ShoppingListsConfiguration;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/api/projects/project#change-product-search-indexing-status
 * @method string getAction()
 * @method ProjectChangeOrderSearchStatusAction setAction(string $action = null)
 * @method ShoppingListsConfiguration getShoppingListsConfiguration()
 * phpcs:disable
 * @method ProjectChangeOrderSearchStatusAction setShoppingListsConfiguration(ShoppingListsConfiguration $shoppingListsConfiguration = null)
 * phpcs:enable
 * @method string getStatus()
 * @method ProjectChangeOrderSearchStatusAction setStatus(string $status = null)
 */
class ProjectChangeOrderSearchStatusAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'status' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeOrderSearchStatus');
    }

    /**
     * @param string $status
     * @param Context|callable $context
     * @return ProjectChangeOrderSearchStatusAction
     */
    public static function ofStatus($status, $context = null)
    {
        return static::of($context)->setEnabled($status);
    }
}
