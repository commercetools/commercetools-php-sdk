<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#remove-asset
 * @method string getAction()
 * @method CategoryRemoveAssetAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategoryRemoveAssetAction setAssetId(string $assetId = null)
 */
class CategoryRemoveAssetAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('removeAsset');
    }

    /**
     * @param string $assetId
     * @param Context|callable $context
     * @return CategoryRemoveAssetAction
     */
    public static function ofAssetId($assetId, $context = null)
    {
        return static::of($context)->setAssetId($assetId);
    }
}
