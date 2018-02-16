<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
 * @method string getAction()
 * @method ProductSetAssetKeyAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetAssetKeyAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetAssetKeyAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductSetAssetKeyAction setAssetId(string $assetId = null)
 * @method string getAssetKey()
 * @method ProductSetAssetKeyAction setAssetKey(string $assetKey = null)
 * @method bool getStaged()
 * @method ProductSetAssetKeyAction setStaged(bool $staged = null)
 */
class ProductSetAssetKeyAction extends AbstractAction
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
        $this->setAction('setAssetKey');
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetKeyAction
     */
    public static function ofVariantIdAndAssetId($variantId, $assetId, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetKeyAction
     */
    public static function ofSkuAndAssetId($sku, $assetId, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId);
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param string $assetKey
     * @param Context|callable $context
     * @return ProductSetAssetKeyAction
     */
    public static function ofVariantIdAssetIdAndAssetKey($variantId, $assetId, $assetKey, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId)->setAssetKey($assetKey);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param string $assetKey
     * @param Context|callable $context
     * @return ProductSetAssetKeyAction
     */
    public static function ofSkuAssetIdAndAssetKey($sku, $assetId, $assetKey, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId)->setAssetKey($assetKey);
    }
}
