<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\Image;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#add-external-image
 * @method string getAction()
 * @method ProductAddExternalImageAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductAddExternalImageAction setVariantId(int $variantId = null)
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
            'image' => [static::TYPE => '\Commercetools\Core\Model\Common\Image'],
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
}
