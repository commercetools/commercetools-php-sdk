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
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-description
 * @method string getAction()
 * @method CategorySetAssetDescriptionAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategorySetAssetDescriptionAction setAssetId(string $assetId = null)
 * @method LocalizedString getDescription()
 * @method CategorySetAssetDescriptionAction setDescription(LocalizedString $description = null)
 * @method string getAssetKey()
 * @method CategorySetAssetDescriptionAction setAssetKey(string $assetKey = null)
 */
class CategorySetAssetDescriptionAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'assetKey' => [static::TYPE => 'string'],
            'description' => [static::TYPE => LocalizedString::class],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAssetDescription');
    }

    /**
     * @param string $assetId
     * @param Context|callable $context
     * @return CategorySetAssetDescriptionAction
     */
    public static function ofAssetId($assetId, $context = null)
    {
        return static::of($context)->setAssetId($assetId);
    }

    /**
     * @param string $assetKey
     * @param Context|callable $context
     * @return CategorySetAssetDescriptionAction
     */
    public static function ofAssetKey($assetKey, $context = null)
    {
        return static::of($context)->setAssetKey($assetKey);
    }
}
