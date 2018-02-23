<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Image;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#add-external-image
 * @method string getAction()
 * @method ProductAddExternalImageAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductAddExternalImageAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductAddExternalImageAction setSku(string $sku = null)
 * @method Image getImage()
 * @method ProductAddExternalImageAction setImage(Image $image = null)
 * @method bool getStaged()
 * @method ProductAddExternalImageAction setStaged(bool $staged = null)
 */
class ProductAddExternalImageAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'image' => [static::TYPE => Image::class],
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
        $this->setAction('addExternalImage');
    }

    /**
     * @param int $variantId
     * @param Image $image
     * @param Context|callable $context
     * @return ProductAddExternalImageAction
     */
    public static function ofVariantIdAndImage($variantId, Image $image, $context = null)
    {
        return static::of($context)->setVariantId($variantId)->setImage($image);
    }

    /**
     * @param string $sku
     * @param Image $image
     * @param Context|callable $context
     * @return ProductAddExternalImageAction
     */
    public static function ofSkuAndImage($sku, Image $image, $context = null)
    {
        return static::of($context)->setSku($sku)->setImage($image);
    }
}
