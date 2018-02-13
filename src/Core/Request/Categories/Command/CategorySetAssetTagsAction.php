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
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-asset-tags
 * @method string getAction()
 * @method CategorySetAssetTagsAction setAction(string $action = null)
 * @method string getAssetId()
 * @method CategorySetAssetTagsAction setAssetId(string $assetId = null)
 * @method array getTags()
 * @method CategorySetAssetTagsAction setTags(array $tags = null)
 */
class CategorySetAssetTagsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetId' => [static::TYPE => 'string'],
            'tags' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setAssetTags');
    }

    /**
     * @param string $assetId
     * @param Context|callable $context
     * @return CategorySetAssetTagsAction
     */
    public static function ofAssetId($assetId, $context = null)
    {
        return static::of($context)->setAssetId($assetId);
    }
}
