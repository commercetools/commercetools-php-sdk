<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductAddToCategoryAction
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#add-to-category
 * @method string getAction()
 * @method ProductAddToCategoryAction setAction(string $action = null)
 * @method CategoryReference getCategory()
 * @method ProductAddToCategoryAction setCategory(CategoryReference $category = null)
 * @method bool getStaged()
 * @method ProductAddToCategoryAction setStaged(bool $staged = null)
 */
class ProductAddToCategoryAction extends AbstractAction
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
        $this->setAction('addToCategory');
        $this->setCategory($categoryReference);
    }
}
