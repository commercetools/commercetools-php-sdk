<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://dev.commercetools.com/http-api-projects-products.html#publish
 * @method string getAction()
 * @method ProductMoveImageToPositionAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductMoveImageToPositionAction setVariantId(int $variantId = null)
 * @method string getSku()
 * @method ProductMoveImageToPositionAction setSku(string $sku = null)
 * @method string getImageUrl()
 * @method ProductMoveImageToPositionAction setImageUrl(string $imageUrl = null)
 * @method int getPosition()
 * @method ProductMoveImageToPositionAction setPosition(int $position = null)
 * @method bool getStaged()
 * @method ProductMoveImageToPositionAction setStaged(bool $staged = null)
 */
class ProductMoveImageToPositionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'sku' => [static::TYPE => 'string'],
            'imageUrl' => [static::TYPE => 'string'],
            'position' => [static::TYPE => 'int'],
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
        $this->setAction('moveImageToPosition');
    }

    public function ofVariantIdImageAndPosition($variantId, $image, $position)
    {
        return static::of()->setVariantId($variantId)->setImageUrl($image)->setPosition($position);
    }

    public function ofSkuImageAndPosition($sku, $image, $position)
    {
        return static::of()->setSku($sku)->setImageUrl($image)->setPosition($position);
    }
}
