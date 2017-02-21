<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShoppingLists\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Request\ShoppingLists\Command
 * @link https://dev.commercetools.com/http-api-projects-shoppingLists.html#set-slug
 * @method string getAction()
 * @method ShoppingListSetSlugAction setAction(string $action = null)
 * @method LocalizedString getSlug()
 * @method ShoppingListSetSlugAction setSlug(LocalizedString $slug = null)
 */
class ShoppingListSetSlugAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'slug' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setSlug');
    }

    /**
     * @param string $slug
     * @param Context|callable $context
     * @return ShoppingListSetSlugAction
     */
    public static function ofSlug($slug, $context = null)
    {
        return static::of($context)->setSlug($slug);
    }
}
