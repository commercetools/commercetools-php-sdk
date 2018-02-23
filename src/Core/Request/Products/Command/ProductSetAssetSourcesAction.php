<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\AssetSourceCollection;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
 * @method string getAction()
 * @method ProductSetAssetSourcesAction setAction(string $action = null)
 * @method bool getStaged()
 * @method ProductSetAssetSourcesAction setStaged(bool $staged = null)
 * @method int getVariantId()
 * @method ProductSetAssetSourcesAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetAssetSourcesAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductSetAssetSourcesAction setAssetId(string $assetId = null)
 * @method AssetSourceCollection getSources()
 * @method ProductSetAssetSourcesAction setSources(AssetSourceCollection $sources = null)
 * @method string getAssetKey()
 * @method ProductSetAssetSourcesAction setAssetKey(string $assetKey = null)
 */
class ProductSetAssetSourcesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'assetKey' => [static::TYPE => 'string'],
            'sources' => [static::TYPE => AssetSourceCollection::class],
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
        $this->setAction('setAssetSources');
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetSourcesAction
     */
    public static function ofVariantIdAndAssetId($variantId, $assetId, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetSourcesAction
     */
    public static function ofSkuAndAssetId($sku, $assetId, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId);
    }

    /**
     * @param int $variantId
     * @param string $assetKey
     * @param Context|callable $context
     * @return ProductSetAssetSourcesAction
     */
    public static function ofVariantIdAndAssetKey($variantId, $assetKey, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetKey($assetKey);
    }

    /**
     * @param string $sku
     * @param string $assetKey
     * @param Context|callable $context
     * @return ProductSetAssetSourcesAction
     */
    public static function ofSkuAndAssetKey($sku, $assetKey, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetKey($assetKey);
    }
}
