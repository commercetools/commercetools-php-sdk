<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Categories\Command;

use Sphere\Core\Model\Category\CategoryReference;
use Sphere\Core\Request\AbstractAction;

/**
 * Class CategoryChangeParentAction
 * @package Sphere\Core\Request\Categories\Command
 * @method string getAction()
 * @method CategoryChangeParentAction setAction(string $action)
 * @method CategoryReference getParent()
 * @method CategoryChangeParentAction setParent(CategoryReference $parent)
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

    public function __construct(CategoryReference $parent)
    {
        $this->setAction('changeParent');
        $this->setParent($parent);
    }
}
