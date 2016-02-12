<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#remove-from-category
 * @method string getAction()
 * @method ProductRemoveFromCategoryAction setAction(string $action = null)
 * @method CategoryReference getCategory()
 * @method ProductRemoveFromCategoryAction setCategory(CategoryReference $category = null)
 * @method bool getStaged()
 * @method ProductRemoveFromCategoryAction setStaged(bool $staged = null)
 */
class ProductRemoveFromCategoryAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'category' => [static::TYPE => '\Commercetools\Core\Model\Category\CategoryReference'],
            'staged' => [static::TYPE => 'bool']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeFromCategory');
    }

    /**
     * @param CategoryReference $categoryReference
     * @param Context|callable $context
     * @return ProductRemoveFromCategoryAction
     */
    public static function ofCategory(CategoryReference $categoryReference, $context = null)
    {
        return static::of($context)->setCategory($categoryReference);
    }
}
