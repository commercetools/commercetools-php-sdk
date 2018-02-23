<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-custom-type
 * @method string getAction()
 * @method CategorySetAssetCustomTypeAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategorySetAssetCustomTypeAction setAssetId(string $assetId = null)
 * @method TypeReference getType()
 * @method CategorySetAssetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method CategorySetAssetCustomTypeAction setFields(FieldContainer $fields = null)
 * @method string getAssetKey()
 * @method CategorySetAssetCustomTypeAction setAssetKey(string $assetKey = null)
 */
class CategorySetAssetCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'assetKey' => [static::TYPE => 'string'],
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
        $this->setAction('setAssetCustomType');
    }

    /**
     * @param TypeReference $type
     * @param string $assetId
     * @param Context|callable $context
     * @return CategorySetAssetCustomTypeAction
     */
    public static function ofTypeAssetIdAndName(TypeReference $type, $assetId, $context = null)
    {
        return static::of($context)->setType($type)->setAssetId($assetId);
    }

    /**
     * @param TypeReference $type
     * @param string $assetKey
     * @param Context|callable $context
     * @return CategorySetAssetCustomTypeAction
     */
    public static function ofTypeAssetKeyAndName(TypeReference $type, $assetKey, $context = null)
    {
        return static::of($context)->setType($type)->setAssetKey($assetKey);
    }
}
