<?php
/**
 *
 */

namespace Commercetools\Core\Model\OrderEdit;

use Commercetools\Core\Model\Common\DateTimeDecorator;
use DateTime;

/**
 * @package Commercetools\Core\Model\OrderEdit
 *
 * @method DateTimeDecorator getAppliedAt()
 * @method OrderEditApplied setAppliedAt(DateTime $appliedAt = null)
 * @method OrderExcerpt getExcerptBeforeEdit()
 * @method OrderEditApplied setExcerptBeforeEdit(OrderExcerpt $excerptBeforeEdit = null)
 * @method OrderExcerpt getExcerptAfterEdit()
 * @method OrderEditApplied setExcerptAfterEdit(OrderExcerpt $excerptAfterEdit = null)
 */
class OrderEditApplied extends OrderEditResult
{
    const ORDER_EDIT_RESULT_TYPE = 'Applied';

    public function fieldDefinitions()
    {
        return [
            'appliedAt' => [
                static::TYPE => DateTime::class,
                static::DECORATOR => DateTimeDecorator::class
            ],
            'excerptBeforeEdit' => [static::TYPE => OrderExcerpt::class],
            'excerptAfterEdit' => [static::TYPE => OrderExcerpt::class]
        ];
    }
}
