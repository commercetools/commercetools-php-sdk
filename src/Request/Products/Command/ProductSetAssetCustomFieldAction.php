<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#set-asset-customfield
 *
 * @method string getAction()
 * @method ProductSetAssetCustomFieldAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductSetAssetCustomFieldAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductSetAssetCustomFieldAction setSku(string $sku = null)
 * @method string getAssetId()
 * @method ProductSetAssetCustomFieldAction setAssetId(string $assetId = null)
 * @method string getName()
 * @method ProductSetAssetCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method ProductSetAssetCustomFieldAction setValue($value = null)
 * @method bool getStaged()
 * @method ProductSetAssetCustomFieldAction setStaged(bool $staged = null)
 */
class ProductSetAssetCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
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
        $this->setAction('setAssetCustomField');
    }

    /**
     * @param int $variantId
     * @param string $assetId
     * @param string $name
     * @param Context|callable $context
     * @return ProductSetAssetCustomFieldAction
     */
    public static function ofVariantIdAssetIdAndName($variantId, $assetId, $name, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setAssetId($assetId)->setName($name);
    }

    /**
     * @param string $sku
     * @param string $assetId
     * @param string $name
     * @param Context|callable $context
     * @return ProductSetAssetCustomFieldAction
     */
    public static function ofSkuAssetIdAndName($sku, $assetId, $name, $context = null)
    {
        return static::of($context)->setSku($sku)->setAssetId($assetId)->setName($name);
    }
}
