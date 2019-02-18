<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Error;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Error
 *
 * @method string getCode()
 * @method DiscountCodeNonApplicableError setCode(string $code = null)
 * @method string getMessage()
 * @method DiscountCodeNonApplicableError setMessage(string $message = null)
 * @method string getDiscountCode()
 * @method DiscountCodeNonApplicableError setDiscountCode(string $discountCode = null)
 * @method string getReason()
 * @method DiscountCodeNonApplicableError setReason(string $reason = null)
 * @method string getDicountCodeId()
 * @method DiscountCodeNonApplicableError setDicountCodeId(string $dicountCodeId = null)
 * @method DateTimeDecorator getValidFrom()
 * @method DiscountCodeNonApplicableError setValidFrom(DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method DiscountCodeNonApplicableError setValidUntil(DateTime $validUntil = null)
 * @method DateTimeDecorator getValidityCheckTime()
 * @method DiscountCodeNonApplicableError setValidityCheckTime(DateTime $validityCheckTime = null)
 */
class DiscountCodeNonApplicableError extends ApiError
{
    const CODE = 'DiscountCodeNonApplicable';

    public function fieldDefinitions()
    {
        $definitions = parent::fieldDefinitions();
        $definitions['discountCode'] = [static::TYPE => 'string'];
        $definitions['reason'] = [static::TYPE => 'string'];
        $definitions['dicountCodeId'] = [static::TYPE => 'string'];
        $definitions['validFrom'] = [
            static::TYPE => DateTime::class,
            static::DECORATOR => DateTimeDecorator::class
        ];
        $definitions['validUntil'] = [
            static::TYPE => DateTime::class,
            static::DECORATOR => DateTimeDecorator::class
        ];
        $definitions['validityCheckTime'] = [
            static::TYPE => DateTime::class,
            static::DECORATOR => DateTimeDecorator::class
        ];

        return $definitions;
    }
}
