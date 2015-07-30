<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductTypes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ProductTypes\Command
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
            'label' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString']
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
