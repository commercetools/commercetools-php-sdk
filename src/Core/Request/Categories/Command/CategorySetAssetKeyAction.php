<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-key
 * @method string getAction()
 * @method CategorySetAssetKeyAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategorySetAssetKeyAction setAssetId(string $assetId = null)
 * @method string getAssetKey()
 * @method CategorySetAssetKeyAction setAssetKey(string $assetKey = null)
 * @method LocalizedString getName()
 * @method CategorySetAssetKeyAction setName(LocalizedString $name = null)
 */
class CategorySetAssetKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'assetKey' => [static::TYPE => 'string'],
            'name' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAssetKey');
    }

    /**
     * @param string $assetId
     * @param Context|callable $context
     * @return CategorySetAssetKeyAction
     */
    public static function ofAssetId($assetId, $context = null)
    {
        return static::of($context)->setAssetId($assetId);
    }

    /**
     * @param string $assetId
     * @param string $assetKey
     * @param Context|callable $context
     * @return CategorySetAssetKeyAction
     */
    public static function ofAssetIdAndAssetKey($assetId, $assetKey, $context = null)
    {
        return static::of($context)->setAssetId($assetId)->setAssetKey($assetKey);
    }
}
