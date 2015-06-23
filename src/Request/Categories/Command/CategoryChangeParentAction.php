<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CategoryChangeParentAction
 * @package Sphere\Core\Request\Categories\Command
 * @link http://dev.sphere.io/http-api-projects-categories.html#change-parent
 * @method string getAction()
 * @method CategoryChangeParentAction setAction(string $action = null)
 * @method CategoryReference getParent()
 * @method CategoryChangeParentAction setParent(CategoryReference $parent = null)
 */
class CategoryChangeParentAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'parent' => [static::TYPE => '\Sphere\Core\Model\Category\CategoryReference']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeParent');
    }

    /**
     * @param CategoryReference $parent
     * @param Context|callable $context
     * @return CategoryChangeParentAction
     */
    public static function ofParentCategory(CategoryReference $parent, $context = null)
    {
        return static::of($context)->setParent($parent);
    }
}
