<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#change-asset-name
 * @method string getAction()
 * @method ProductChangeAssetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method ProductChangeAssetNameAction setName(LocalizedString $name = null)
 * @method bool getStaged()
 * @method ProductChangeAssetNameAction setStaged(bool $staged = null)
 * @method int getVariantId()
 * @method ProductChangeAssetNameAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductChangeAssetNameAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductChangeAssetNameAction setAssetId(string $assetId = null)
 */
class ProductChangeAssetNameAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
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
        $this->setAction('changeAssetName');
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return ProductRemoveAssetAction
     */
    public static function ofVariantIdAssetIdAndName($variantId, $assetId, LocalizedString $name, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId)->setName($name);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return ProductRemoveAssetAction
     */
    public static function ofSkuAssetIdAndName($sku, $assetId, LocalizedString $name, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId)->setName($name);
    }
}
