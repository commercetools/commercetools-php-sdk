<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Categories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\LocalizedString;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\Categories\Command
 * @link https://dev.commercetools.com/http-api-projects-categories.html#set-meta-keywords
 * @method string getAction()
 * @method CategorySetMetaKeywordsAction setAction(string $action = null)
 * @method LocalizedString getMetaKeywords()
 * @method CategorySetMetaKeywordsAction setMetaKeywords(LocalizedString $metaKeywords = null)
 */
class CategorySetMetaKeywordsAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaKeywords' => [static::TYPE => LocalizedString::class],
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
