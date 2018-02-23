<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ShippingMethods\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\ShippingMethods\Command
 * @link https://docs.commercetools.com/http-api-projects-shippingMethods.html#set-predicate
 * @method string getAction()
 * @method ShippingMethodSetPredicateAction setAction(string $action = null)
 * @method string getPredicate()
 * @method ShippingMethodSetPredicateAction setPredicate(string $predicate = null)
 */
class ShippingMethodSetPredicateAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'predicate' => [static::TYPE => 'string'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setPredicate');
    }
}
