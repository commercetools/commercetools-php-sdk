<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Category\CategoryReference;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link http://dev.commercetools.com/http-api-projects-categories.html#change-parent
 * @method string getAction()
 * @method CategoryChangeParentAction setAction(string $action = null)
 * @method CategoryReference getParent()
 * @method CategoryChangeParentAction setParent(CategoryReference $parent = null)
 */
class CategoryChangeParentAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'parent' => [static::TYPE => '\Commercetools\Core\Model\Category\CategoryReference']
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
