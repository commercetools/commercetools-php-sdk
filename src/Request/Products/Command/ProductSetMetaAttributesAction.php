<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Products\Command
 * @link http://dev.commercetools.com/http-api-projects-products.html#set-meta-attributes
 * @deprecated will be removed in RC1
 * @method string getAction()
 * @method ProductSetMetaAttributesAction setAction(string $action = null)
 * @method LocalizedString getMetaTitle()
 * @method ProductSetMetaAttributesAction setMetaTitle(LocalizedString $metaTitle = null)
 * @method LocalizedString getMetaDescription()
 * @method ProductSetMetaAttributesAction setMetaDescription(LocalizedString $metaDescription = null)
 * @method LocalizedString getMetaKeywords()
 * @method ProductSetMetaAttributesAction setMetaKeywords(LocalizedString $metaKeywords = null)
 * @method bool getStaged()
 * @method ProductSetMetaAttributesAction setStaged(bool $staged = null)
 */
class ProductSetMetaAttributesAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaTitle' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaDescription' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'metaKeywords' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
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
        $this->setAction('setMetaAttributes');
    }
}
