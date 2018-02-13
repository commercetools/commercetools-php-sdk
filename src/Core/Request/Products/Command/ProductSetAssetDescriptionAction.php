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
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
 * @method string getAction()
 * @method ProductSetAssetDescriptionAction setAction(string $action = null)
 * @method bool getStaged()
 * @method ProductSetAssetDescriptionAction setStaged(bool $staged = null)
 * @method int getVariantId()
 * @method ProductSetAssetDescriptionAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetAssetDescriptionAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductSetAssetDescriptionAction setAssetId(string $assetId = null)
 * @method LocalizedString getDescription()
 * @method ProductSetAssetDescriptionAction setDescription(LocalizedString $description = null)
 */
class ProductSetAssetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
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
        $this->setAction('setAssetDescription');
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetDescriptionAction
     */
    public static function ofVariantIdAndAssetId($variantId, $assetId, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param Context|callable $context
     * @return ProductSetAssetDescriptionAction
     */
    public static function ofSkuAndAssetId($sku, $assetId, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId);
    }
}
