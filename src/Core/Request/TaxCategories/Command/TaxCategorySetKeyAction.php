<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\TaxCategories\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\TaxCategories\Command
 * @link https://docs.commercetools.com/http-api-projects-taxCategories.html#set-key
 * @method string getKey()
 * @method TaxCategorySetKeyAction setKey(string $key = null)
 * @method string getAction()
 * @method TaxCategorySetKeyAction setAction(string $action = null)
 */
class TaxCategorySetKeyAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'key' => [static::TYPE => 'string']
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setKey');
    }

    /**
     * @param string $key
     * @param Context|callable $context
     * @return TaxCategorySetKeyAction
     */
    public static function ofKey($key, $context = null)
    {
        return static::of($context)->setKey($key);
    }
}
