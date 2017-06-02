<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Types\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Types\Command
 * @link https://dev.commercetools.com/http-api-projects-types.html#change-fielddefinition-label
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
            'label' => [static::TYPE => LocalizedString::class]
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
     * @param string $fieldname
     * @param LocalizedString $label
     * @param Context|callable $context
     * @return TypeChangeLabelAction
     */
    public static function ofNameAndLabel($fieldname, LocalizedString $label, $context = null)
    {
        return static::of($context)->setFieldName($fieldname)->setLabel($label);
    }
}
