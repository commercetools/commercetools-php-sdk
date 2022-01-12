<?php

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Project\ShoppingListsConfiguration;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/api/projects/project#change-product-search-indexing-enabled
 * @method string getAction()
 * @method ProjectChangeProductSearchIndexingEnabledAction setAction(string $action = null)
 * @method ShoppingListsConfiguration getShoppingListsConfiguration()
 * phpcs:disable
 * @method ProjectChangeProductSearchIndexingEnabledAction setShoppingListsConfiguration(ShoppingListsConfiguration $shoppingListsConfiguration = null)
 * phpcs:enable
 * @method bool getEnabled()
 * @method ProjectChangeProductSearchIndexingEnabledAction setEnabled(bool $enabled = null)
 */
class ProjectChangeProductSearchIndexingEnabledAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'enabled' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeProductSearchIndexingEnabled');
    }

    /**
     * @param boolean $enabled
     * @param Context|callable $context
     * @return ProjectChangeProductSearchIndexingEnabledAction
     */
    public static function ofEnabled($enabled, $context = null)
    {
        return static::of($context)->setEnabled($enabled);
    }
}
