<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\AssetDraft;

/**
 * @package Commercetools\Core\Request\Products\Command
 *
 * @method string getAction()
 * @method ProductChangeAssetOrderAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductChangeAssetOrderAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductChangeAssetOrderAction setSku(string $sku = null)
 * @method AssetDraft getAsset()
 * @method ProductChangeAssetOrderAction setAsset(AssetDraft $asset = null)
 * @method bool getStaged()
 * @method ProductChangeAssetOrderAction setStaged(bool $staged = null)
 * @method array getAssetOrder()
 * @method ProductChangeAssetOrderAction setAssetOrder(array $assetOrder = null)
 */
class ProductChangeAssetOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetOrder' => [static::TYPE => 'array'],
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
        $this->setAction('changeAssetOrder');
    }

    /**
     * @param int $variantId
     * @param Context|callable $context
     * @return ProductAddExternalImageAction
     */
    public static function ofVariantId($variantId, $context = null)
    {
        return static::of($context)->setVariantId($variantId);
    }

    /**
     * @param string $sku
     * @param Context|callable $context
     * @return ProductAddExternalImageAction
     */
    public static function ofSku($sku, $context = null)
    {
        return static::of($context)->setSku($sku);
    }
}
