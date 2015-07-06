<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Request\AbstractAction;

class ProductTypeRemoveAttributeDefinitionAction extends AbstractAction
{
    public function getFields()
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
