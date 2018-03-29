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
 *
 * @link https://docs.commercetools.com/http-api-projects-categories.html#change-asset-order
 * @method string getAction()
 * @method CategoryChangeAssetOrderAction setAction(string $action = null)
 * @method array getAssetOrder()
 * @method CategoryChangeAssetOrderAction setAssetOrder(array $assetOrder = null)
 */
class CategoryChangeAssetOrderAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'assetOrder' => [static::TYPE => 'array'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeAssetOrder');
    }
}
