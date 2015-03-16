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
 * @method string getAction()
 * @method ProductAddToCategoryAction setAction(string $action)
 * @method CategoryReference getCategory()
 * @method ProductAddToCategoryAction setCategory(CategoryReference $category)
 */
class ProductAddToCategoryAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'category' => [static::TYPE => '\Sphere\Core\Model\Category\CategoryReference'],
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
