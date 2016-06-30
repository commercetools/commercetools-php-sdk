<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\DiscountCodes\Command;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractAction;

/**
 * @package Commercetools\Core\Request\DiscountCodes\Command
 * @link https://dev.commercetools.com/http-api-projects-discountCodes.html#change-isactive
 * @method string getAction()
 * @method DiscountCodeChangeIsActiveAction setAction(string $action = null)
 * @method bool getIsActive()
 * @method DiscountCodeChangeIsActiveAction setIsActive(bool $isActive = null)
 */
class DiscountCodeChangeIsActiveAction extends AbstractAction
{
    public function fieldDefinitions()
    {
        return [
            'action' => [static::TYPE => 'string'],
            'isActive' => [static::TYPE => 'bool'],
        ];
    }

    /**
     * @param array $data
     * @param Context|callable $context
     */
    public function __construct(array $data = [], $context = null)
    {
        parent::__construct($data, $context);
        $this->setAction('changeIsActive');
    }

    /**
     * @param bool $isActive
     * @param Context|callable $context
     * @return DiscountCodeChangeIsActiveAction
     */
    public static function ofIsActive($isActive, $context = null)
    {
        return static::of($context)->setIsActive($isActive);
    }
}
