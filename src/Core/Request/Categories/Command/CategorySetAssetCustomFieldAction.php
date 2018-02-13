<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\CustomField\Command\SetCustomFieldAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-customfield
 *
 * @method string getAction()
 * @method CategorySetAssetCustomFieldAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategorySetAssetCustomFieldAction setAssetId(string $assetId = null)
 * @method string getName()
 * @method CategorySetAssetCustomFieldAction setName(string $name = null)
 * @method mixed getValue()
 * @method CategorySetAssetCustomFieldAction setValue($value = null)
 */
class CategorySetAssetCustomFieldAction extends SetCustomFieldAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'name' => [static::TYPE => 'string'],
            'value' => [static::TYPE => null],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAssetCustomField');
    }

    /**
     * @param string $assetId
     * @param string $name
     * @param Context|callable $context
     * @return CategorySetAssetCustomFieldAction
     */
    public static function ofAssetIdAndName($assetId, $name, $context = null)
    {
        return static::of($context)->setAssetId($assetId)->setName($name);
    }
}
