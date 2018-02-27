<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\CustomField\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\CustomField\FieldContainer;

/**
 * @package Commercetools\Core\Request\CustomField\Command
 * @ramlTestIgnoreClass
 * @method string getAction()
 * @method SetCustomTypeAction setAction(string $action = null)
 * @method FieldContainer getFields()
 * @method SetCustomTypeAction setFields(FieldContainer $fields = null)
 * @method TypeReference getType()
 * @method SetCustomTypeAction setType(TypeReference $type = null)
 */
class SetCustomTypeAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'type' => [static::TYPE => TypeReference::class],
            'fields' => [static::TYPE => FieldContainer::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setCustomType');
    }

    /**
     * @param string $typeId
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeId($typeId, $context = null)
    {
        return static::ofType(TypeReference::ofId($typeId), $context);
    }

    /**
     * @param string $typeKey
     * @param Context|callable $context
     * @return static
     */
    public static function ofTypeKey($typeKey, $context = null)
    {
        return static::ofType(TypeReference::ofKey($typeKey), $context);
    }

    /**
     * @param TypeReference $type
     * @param Context|callable $context
     * @return static
     */
    public static function ofType(TypeReference $type, $context = null)
    {
        return static::of($context)->setType($type);
    }
}
