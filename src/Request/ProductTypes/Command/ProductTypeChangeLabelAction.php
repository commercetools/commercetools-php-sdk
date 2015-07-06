<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

class ProductTypeChangeLabelAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'attributeName' => [static::TYPE => 'string'],
            'label' => [static::TYPE => '\Sphere\Core\Model\Common\LocalizedString']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeLabel');
    }

    /**
     * @param string $attributeName
     * @param LocalizedString $label
     * @param Context|callable $context
     * @return ProductTypeChangeLabelAction
     */
    public static function ofAttributeNameAndLabel($attributeName, LocalizedString $label, $context = null)
    {
        return static::of($context)->setAttributeName($attributeName)->setLabel($label);
    }
}
