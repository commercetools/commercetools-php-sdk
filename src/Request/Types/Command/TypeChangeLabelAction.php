<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 *
 * @method string getAction()
 * @method TypeChangeLabelAction setAction(string $action = null)
 * @method string getFieldName()
 * @method TypeChangeLabelAction setFieldName(string $fieldName = null)
 * @method LocalizedString getLabel()
 * @method TypeChangeLabelAction setLabel(LocalizedString $label = null)
 */
class TypeChangeLabelAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'fieldName' => [static::TYPE => 'string'],
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
     * @param LocalizedString $label
     * @param Context|callable $context
     * @return TypeChangeLabelAction
     */
    public static function ofLabel(LocalizedString $label, $context = null)
    {
        return static::of($context)->setLabel($label);
    }
}
