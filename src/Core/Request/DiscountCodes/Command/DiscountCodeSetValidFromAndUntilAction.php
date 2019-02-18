<?php
/**
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-valid-from-and-until
 * @method string getAction()
 * @method DiscountCodeSetValidFromAndUntilAction setAction(string $action = null)
 * @method DateTimeDecorator getValidFrom()
 * @method DiscountCodeSetValidFromAndUntilAction setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method DiscountCodeSetValidFromAndUntilAction setValidUntil(DateTime $validUntil = null)
 */
class DiscountCodeSetValidFromAndUntilAction extends AbstractAction
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
