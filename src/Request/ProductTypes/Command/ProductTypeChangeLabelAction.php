<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\ProductTypes\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\LocalizedString;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\ProductTypes\Command
 * 
 * @method string getAction()
 * @method ProductTypeChangeLabelAction setAction(string $action = null)
 * @method string getAttributeName()
 * @method ProductTypeChangeLabelAction setAttributeName(string $attributeName = null)
 * @method LocalizedString getLabel()
 * @method ProductTypeChangeLabelAction setLabel(LocalizedString $label = null)
 */
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
