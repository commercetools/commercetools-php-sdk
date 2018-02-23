<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#remove-image
 * @method string getAction()
 * @method ProductRemoveImageAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductRemoveImageAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductRemoveImageAction setSku(string $sku = null)
 * @method string getImageUrl()
 * @method ProductRemoveImageAction setImageUrl(string $imageUrl = null)
 * @method bool getStaged()
 * @method ProductRemoveImageAction setStaged(bool $staged = null)
 */
class ProductRemoveImageAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'imageUrl' => [static::TYPE => 'string'],
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
        $this->setAction('removeImage');
    }

    /**
     * @param int $variantId
     * @param string $imageUrl
     * @param Context|callable $context
     * @return ProductRemoveImageAction
     */
    public static function ofVariantIdAndImageUrl($variantId, $imageUrl, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setImageUrl($imageUrl);
    }

    /**
     * @param string $sku
     * @param string $imageUrl
     * @param Context|callable $context
     * @return ProductRemoveImageAction
     */
    public static function ofSkuAndImageUrl($sku, $imageUrl, $context = null)
    {
        return static::of($context)->setSku($sku)->setImageUrl($imageUrl);
    }
}
