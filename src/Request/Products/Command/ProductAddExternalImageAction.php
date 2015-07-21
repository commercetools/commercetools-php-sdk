<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\Common\Image;
use Sphere\Core\Request\AbstractAction;

/**
 * @package Sphere\Core\Request\Products\Command
 * @link http://dev.sphere.io/http-api-projects-products.html#add-external-image
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
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'image' => [static::TYPE => '\Sphere\Core\Model\Common\Image'],
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
