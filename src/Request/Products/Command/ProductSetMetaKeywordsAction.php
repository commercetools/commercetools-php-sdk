<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#set-meta-keywords
 * @method string getAction()
 * @method ProductSetMetaKeywordsAction setAction(string $action = null)
 * @method LocalizedString getMetaKeywords()
 * @method ProductSetMetaKeywordsAction setMetaKeywords(LocalizedString $metaKeywords = null)
 */
class ProductSetMetaKeywordsAction extends AbstractAction
{
    public function getFields()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaKeywords' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setMetaKeywords');
    }
}
