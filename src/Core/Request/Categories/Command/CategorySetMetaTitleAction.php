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
 * @link https://docs.commercetools.com/http-api-projects-categories.html#set-meta-title
 * @method string getAction()
 * @method CategorySetMetaTitleAction setAction(string $action = null)
 * @method LocalizedString getMetaTitle()
 * @method CategorySetMetaTitleAction setMetaTitle(LocalizedString $metaTitle = null)
 */
class CategorySetMetaTitleAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'metaTitle' => [static::TYPE => LocalizedString::class],
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
