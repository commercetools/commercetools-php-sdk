<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\TaxCategories\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

/**
 * Class TaxCategorySetDescriptionAction
 * @package Sphere\Core\Request\TaxCategories\Command
 * 
 * @method string getAction()
 * @method TaxCategorySetDescriptionAction setAction(string $action = null)
 * @method string getDescription()
 * @method TaxCategorySetDescriptionAction setDescription(string $description = null)
 */
class TaxCategorySetDescriptionAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setDescription');
    }
}
