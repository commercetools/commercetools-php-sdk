<?php
/**
 */

namespace Commercetools\Core\Request\CartDiscounts\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\CartDiscounts\Command
 * @link https://docs.commercetools.com/http-api-projects-cartDiscounts.html#set-valid-from-and-until
 * @method string getAction()
 * @method CartDiscountSetValidFromAndUntilAction setAction(string $action = null)
 * @method DateTimeDecorator getValidFrom()
 * @method CartDiscountSetValidFromAndUntilAction setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method CartDiscountSetValidFromAndUntilAction setValidUntil(DateTime $validUntil = null)
 */
class CartDiscountSetValidFromAndUntilAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'validFrom' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'validUntil' => [
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
        $this->setAction('setValidFromAndUntil');
    }
}
