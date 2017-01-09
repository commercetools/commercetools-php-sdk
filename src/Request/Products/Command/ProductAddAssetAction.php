<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Asset;
use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\AssetDraft;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#add-asset
 * @method string getAction()
 * @method ProductAddAssetAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductAddAssetAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductAddAssetAction setSku(string $sku = null)
 * @method AssetDraft getAsset()
 * @method ProductAddAssetAction setAsset(AssetDraft $asset = null)
 * @method bool getStaged()
 * @method ProductAddAssetAction setStaged(bool $staged = null)
 */
class ProductAddAssetAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'asset' => [static::TYPE => AssetDraft::class],
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
        $this->setAction('addAsset');
    }

    /**
     * @param int $variantId
     * @param AssetDraft $asset
     * @param Context|callable $context
     * @return ProductAddExternalImageAction
     */
    public static function ofVariantIdAndAsset($variantId, AssetDraft $asset, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAsset($asset);
    }

    /**
     * @param string $sku
     * @param AssetDraft $asset
     * @param Context|callable $context
     * @return ProductAddExternalImageAction
     */
    public static function ofSkuAndAsset($sku, AssetDraft $asset, $context = null)
    {
        return static::of($context)->setSku($sku)->setAsset($asset);
    }
}
