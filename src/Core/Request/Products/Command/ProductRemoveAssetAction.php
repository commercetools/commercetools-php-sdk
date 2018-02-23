<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
 * @method string getAction()
 * @method ProductRemoveAssetAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductRemoveAssetAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductRemoveAssetAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductRemoveAssetAction setAssetId(string $assetId = null)
 * @method bool getStaged()
 * @method ProductRemoveAssetAction setStaged(bool $staged = null)
 * @method string getAssetKey()
 * @method ProductRemoveAssetAction setAssetKey(string $assetKey = null)
 */
class ProductRemoveAssetAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'assetKey' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeAsset');
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductRemoveAssetAction
     */
    public static function ofVariantIdAndAssetId($variantId, $assetId, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductRemoveAssetAction
     */
    public static function ofSkuAndAssetId($sku, $assetId, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId);
    }

    /**
     * @param int $variantId
     * @param string $assetKey
     * @param Context|callable $context
     * @return ProductRemoveAssetAction
     */
    public static function ofVariantIdAndAssetKey($variantId, $assetKey, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetKey($assetKey);
    }

    /**
     * @param string $sku
     * @param string $assetKey
     * @param Context|callable $context
     * @return ProductRemoveAssetAction
     */
    public static function ofSkuAndAssetKey($sku, $assetKey, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetKey($assetKey);
    }
}
