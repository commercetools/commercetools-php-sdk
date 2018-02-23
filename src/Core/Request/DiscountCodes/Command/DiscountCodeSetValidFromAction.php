<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\DateTimeDecorator;
use Commercetools\Core\Request\AbstractAction;
use DateTime;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://docs.commercetools.com/http-api-projects-discountCodes.html#set-valid-from
 * @method string getAction()
 * @method DiscountCodeSetValidFromAction setAction(string $action = null)
 * @method DiscountCodeSetValidFromAction setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidFrom()
 */
class DiscountCodeSetValidFromAction extends AbstractAction
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
