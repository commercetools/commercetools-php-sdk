<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\ProductDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\ProductDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-productDiscounts.html#set-valid-from
 * @method string getAction()
 * @method ProductDiscountSetValidFromAction setAction(string $action = null)
 * @method DateTimeDecorator getValidFrom()
 * @method ProductDiscountSetValidFromAction setValidFrom(DateTime $validFrom = null)
 */
class ProductDiscountSetValidFromAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'validFrom' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('setValidFrom');
    }
}
