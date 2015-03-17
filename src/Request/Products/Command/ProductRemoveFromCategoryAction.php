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
 * @method string getAction()
 * @method ProductRemoveFromCategoryAction setAction(string $action)
 * @method CategoryReference getCategory()
 * @method ProductRemoveFromCategoryAction setCategory(CategoryReference $category)
 * @method bool getStaged()
 * @method ProductRemoveFromCategoryAction setStaged(bool $staged)
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
