<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomTypeAction;
use Commercetools\Core\Model\CustomField\FieldContainer;
use Commercetools\Core\Model\Type\TypeReference;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#set-asset-custom-type
 * @method string getAction()
 * @method ProductSetAssetCustomTypeAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetAssetCustomTypeAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetAssetCustomTypeAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductSetAssetCustomTypeAction setAssetId(string $assetId = null)
 * @method bool getStaged()
 * @method ProductSetAssetCustomTypeAction setStaged(bool $staged = null)
 * @method TypeReference getType()
 * @method ProductSetAssetCustomTypeAction setType(TypeReference $type = null)
 * @method FieldContainer getFields()
 * @method ProductSetAssetCustomTypeAction setFields(FieldContainer $fields = null)
 */
class ProductSetAssetCustomTypeAction extends SetCustomTypeAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
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
     * @param int $variantId
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetCustomTypeAction
     */
    public static function ofTypeVariantIdAssetIdAndName(TypeReference $type, $variantId, $assetId, $context = null)
    {
        return static::of($context)->setType($type)->setVariantId($variantId)->setAssetId($assetId);
    }

    /**
     * @param TypeReference $type
     * @param string $sku
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetCustomTypeAction
     */
    public static function ofTypeSkuAssetIdAndName(TypeReference $type, $sku, $assetId, $context = null)
    {
        return static::of($context)->setType($type)->setSku($sku)->setAssetId($assetId);
    }
}
