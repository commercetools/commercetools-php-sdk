<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\AssetDraft;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#add-asset
 * @method string getAction()
 * @method CategoryAddAssetAction setAction(string $action = null)
 * @method AssetDraft getAsset()
 * @method CategoryAddAssetAction setAsset(AssetDraft $asset = null)
 */
class CategoryAddAssetAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'asset' => [static::TYPE => AssetDraft::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('addAsset');
    }

    /**
     * @param AssetDraft $asset
     * @param Context|callable $context
     * @return CategoryAddAssetAction
     */
    public static function ofAsset(AssetDraft $asset, $context = null)
    {
        return static::of($context)->setAsset($asset);
    }
}
