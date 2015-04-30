<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductRemoveFromCategoryAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#remove-from-category
 * @method string getAction()
 * @method ProductRemoveFromCategoryAction setAction(string $action = null)
 * @method CategoryReference getCategory()
 * @method ProductRemoveFromCategoryAction setCategory(CategoryReference $category = null)
 * @method bool getStaged()
 * @method ProductRemoveFromCategoryAction setStaged(bool $staged = null)
 */
class ProductRemoveFromCategoryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'category' => [static::TYPE => '\Sphere\Core\Model\Category\CategoryReference'],
            'staged' => [static::TYPE => 'bool']
        ];
    }

    /**
     * @param CategoryReference $categoryReference
     */
    public function __construct(CategoryReference $categoryReference)
    {
        $this->setAction('removeFromCategory');
        $this->setCategory($categoryReference);
    }
}
