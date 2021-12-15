<?php

namespace Commercetools\Core\Request\Project\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Project\ShoppingListsConfiguration;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Project\Command
 * @link https://docs.commercetools.com/http-api-projects-project.html#change-shopping-lists-configuration
 * @method string getAction()
 * @method ProjectChangeShoppingListsConfiguration setAction(string $action = null)
 * @method ShoppingListsConfiguration getShoppingListsConfiguration()
 * phpcs:disable
 * @method ProjectChangeShoppingListsConfiguration setShoppingListsConfiguration(ShoppingListsConfiguration $shoppingListsConfiguration = null)
 * phpcs:enable
 */
class ProjectChangeShoppingListsConfiguration extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'shoppingListsConfiguration' => [static::TYPE => ShoppingListsConfiguration::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeShoppingListsConfiguration');
    }

    /**
     * @param ShoppingListsConfiguration $shoppingListsConfiguration
     * @param Context|callable $context
     * @return ProjectChangeShoppingListsConfiguration
     */
    public static function ofShoppingListsConfiguration(ShoppingListsConfiguration $shoppingListsConfiguration, $context = null)
    {
        return static::of($context)->setShoppingListsConfiguration($shoppingListsConfiguration);
    }
}
