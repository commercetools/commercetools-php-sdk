<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link https://docs.commercetools.com/http-api-projects-products.html#set-meta-title
 * @method string getAction()
 * @method ProductSetMetaTitleAction setAction(string $action = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductSetMetaTitleAction setMetaTitle(LocalizedString $metaTitle = null)
 * @method bool getStaged()
 * @method ProductSetMetaTitleAction setStaged(bool $staged = null)
 */
class ProductSetMetaTitleAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaTitle' => [static::TYPE => LocalizedString::class],
            'staged' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMetaTitle');
    }
}
