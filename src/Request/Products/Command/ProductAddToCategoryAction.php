<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#add-to-category
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
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addToCategory');
    }

    /**
     * @param CategoryReference $categoryReference
     * @param Context|callable $context
     * @return ProductAddToCategoryAction
     */
    public static function ofCategory(CategoryReference $categoryReference, $context = null)
    {
        return static::of($context)->setCategory($categoryReference);
    }
}
