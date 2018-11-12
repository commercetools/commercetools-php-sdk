<?php
/**
 *
 */

namespace Commercetools\Core\Request\OrderEdits;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\OrderEdit\OrderEdit;
use Commercetools\Core\Model\OrderEdit\OrderEditDraft;
use Commercetools\Core\Request\AbstractCreateRequest;
use Commercetools\Core\Response\ApiResponseInterface;
use Commercetools\Core\Model\MapperInterface;

/**
 * @package Commercetools\Core\Request\OrderEdits
 *
 * @method OrderEdit mapResponse(ApiResponseInterface $response)
 * @method OrderEdit mapFromResponse(ApiResponseInterface $response, MapperInterface $mapper = null)
 */
class OrderEditCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = OrderEdit::class;

    /**
     * OrderEditCreateRequest constructor.
     * @param OrderEditDraft $orderEdit
     * @param Context|null $context
     */
    public function __construct(OrderEditDraft $orderEdit, Context $context = null)
    {
        parent::__construct(OrderEditsEndpoint::endpoint(), $orderEdit, $context);
    }

    /**
     * @param OrderEditDraft $orderEdit
     * @param Context|null $context
     * @return OrderEditCreateRequest
     */
    public static function ofDraft(OrderEditDraft $orderEdit, Context $context = null)
    {
        return new static($orderEdit, $context);
    }
}
