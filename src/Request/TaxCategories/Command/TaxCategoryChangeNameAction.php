<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class TaxCategoryChangeNameAction
 * @package Sphere\Core\Request\TaxCategories\Command
 * 
 * @method string getAction()
 * @method TaxCategoryChangeNameAction setAction(string $action = null)
 * @method string getName()
 * @method TaxCategoryChangeNameAction setName(string $name = null)
 */
class TaxCategoryChangeNameAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeName');
    }

    /**
     * @param string $name
     * @param Context|callable $context
     * @return TaxCategoryChangeNameAction
     */
    public function ofName($name, $context = null)
    {
        return static::of($context)->setName($name);
    }
}
