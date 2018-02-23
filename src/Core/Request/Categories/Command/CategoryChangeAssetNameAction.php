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
 * @link https://docs.commercetools.com/http-api-projects-products.html#change-asset-name
 * @method string getAction()
 * @method CategoryChangeAssetNameAction setAction(string $action = null)
 * @method LocalizedString getName()
 * @method CategoryChangeAssetNameAction setName(LocalizedString $name = null)
 * @method string getAssetId()
 * @method CategoryChangeAssetNameAction setAssetId(string $assetId = null)
 * @method string getAssetKey()
 * @method CategoryChangeAssetNameAction setAssetKey(string $assetKey = null)
 */
class CategoryChangeAssetNameAction extends AbstractAction
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
        $this->setAction('changeAssetName');
    }

    /**
     * @param string $assetId
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return CategoryChangeAssetNameAction
     */
    public static function ofAssetIdAndName($assetId, LocalizedString $name, $context = null)
    {
        return static::of($context)->setAssetId($assetId)->setName($name);
    }

    /**
     * @param string $assetKey
     * @param LocalizedString $name
     * @param Context|callable $context
     * @return CategoryChangeAssetNameAction
     */
    public static function ofAssetKeyAndName($assetKey, LocalizedString $name, $context = null)
    {
        return static::of($context)->setAssetKey($assetKey)->setName($name);
    }
}
