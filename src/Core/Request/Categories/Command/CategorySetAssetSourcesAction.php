<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\AssetSourceCollection;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
 * @method string getAction()
 * @method CategorySetAssetSourcesAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategorySetAssetSourcesAction setAssetId(string $assetId = null)
 * @method AssetSourceCollection getSources()
 * @method CategorySetAssetSourcesAction setSources(AssetSourceCollection $sources = null)
 * @method string getAssetKey()
 * @method CategorySetAssetSourcesAction setAssetKey(string $assetKey = null)
 */
class CategorySetAssetSourcesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'assetKey' => [static::TYPE => 'string'],
            'sources' => [static::TYPE => AssetSourceCollection::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAssetSources');
    }

    /**
     * @param string $assetId
     * @param Context|callable $context
     * @return CategorySetAssetSourcesAction
     */
    public static function ofAssetId($assetId, $context = null)
    {
        return static::of($context)->setAssetId($assetId);
    }

    /**
     * @param string $assetKey
     * @param Context|callable $context
     * @return CategorySetAssetSourcesAction
     */
    public static function ofAssetKey($assetKey, $context = null)
    {
        return static::of($context)->setAssetKey($assetKey);
    }
}
