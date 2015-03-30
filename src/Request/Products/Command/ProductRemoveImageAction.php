<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\Products\Command;

use Sphere\Core\Request\AbstractAction;

/**
 * Class ProductRemoveImageAction
 * @package Sphere\Core\Request\Products\Command
 * @method string getAction()
 * @method ProductRemoveImageAction setAction(string $action = null)
 * @method int getVariantId()
 * @method ProductRemoveImageAction setVariantId(int $variantId = null)
 * @method string getImageUrl()
 * @method ProductRemoveImageAction setImageUrl(string $imageUrl = null)
 * @method bool getStaged()
 * @method ProductRemoveImageAction setStaged(bool $staged = null)
 */
class ProductRemoveImageAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'variantId' => [static::TYPE => 'int'],
            'imageUrl' => [static::TYPE => 'string'],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param int $variantId
     * @param string $imageUrl
     */
    public function __construct($variantId, $imageUrl)
    {
        $this->setAction('removeImage');
        $this->setVariantId($variantId);
        $this->setImageUrl($imageUrl);
    }
}
