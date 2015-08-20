<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
 *
 * @method string getAction()
 * @method ProductTypeRemoveAttributeDefinitionAction setAction(string $action = null)
 * @method string getName()
 * @method ProductTypeRemoveAttributeDefinitionAction setName(string $name = null)
 */
class ProductTypeRemoveAttributeDefinitionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeAttributeDefinition');
    }

    /**
     * @param string $attributeName
     * @param Context|callable $context
     * @return ProductTypeRemoveAttributeDefinitionAction
     */
    public static function ofName($attributeName, $context = null)
    {
        return static::of($context)->setName($attributeName);
    }
}
