<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-category-order-hint
 * @method string getAction()
 * @method ProductSetCategoryOrderHintAction setAction(string $action = null)
 * @method string getCategoryId()
 * @method ProductSetCategoryOrderHintAction setCategoryId(string $categoryId = null)
 * @method string getOrderHint()
 * @method ProductSetCategoryOrderHintAction setOrderHint(string $orderHint = null)
 * @method bool getStaged()
 * @method ProductSetCategoryOrderHintAction setStaged(bool $staged = null)
 */
class ProductSetCategoryOrderHintAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'categoryId' => [static::TYPE => 'string'],
            'orderHint' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCategoryOrderHint');
    }

    /**
     * @param string $categoryId
     * @param Context|callable $context
     * @return ProductSetCategoryOrderHintAction
     */
    public static function ofCategoryId($categoryId, $context = null)
    {
        return static::of($context)->setCategoryId($categoryId);
    }
}
